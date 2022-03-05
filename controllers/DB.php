<?php

namespace controllers;

use mysqli;

class DB
{
    private string $dbServerName = "31.170.164.95";
    private string $dbUsername = "u973673548_volley";
    private string $dbPassword = "4ga5IIMC9JgM9ljspkI\$d";
    private string $dbName = "u973673548_volley";
    protected mysqli $connection;

    public function __construct()
    {
        $this->connection = $this->connect();
    }

    private function connect(): mysqli
    {
        $conexion = new mysqli($this->dbServerName, $this->dbUsername, $this->dbPassword, $this->dbName, "3306");
        if ($conexion->connect_error) {
            die("Connection failed: " . $conexion->connect_errno);
        }
        return $conexion;
    }

    public function select(string $sqlQuery): ?array
    {
        $result = $this->connection->query($sqlQuery);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        return null;
    }

    public function validateIfEmailIsAlreadyBeingUsed(string $user_email): bool
    {
        $userSelection = $this->connection->query("SELECT id FROM `user` WHERE email='$user_email'");
        if ($userSelection->num_rows > 0) {
            return $userSelection->fetch_assoc()['id'];
        }
        return false;
    }

    public function updateUser(int $user_id, string $user_name, string $user_email, string $user_password, $isAdmin): bool
    {
        if (empty($user_password)) {
            $update = $this->connection->query("UPDATE `user` SET 
                  `name`='$user_name',
                  `email`='$user_email',
                  `isAdmin` = {$isAdmin}
                WHERE `id`='$user_id'");

        } else {
            $md5Password = md5($user_password);
            $update = $this->connection->query
            ("UPDATE `user` SET
                  `name`='$user_name',
                  `email`='$user_email',
                  `isAdmin` = {$isAdmin},
                  `password`='$md5Password' 
                WHERE `id`='$user_id'");
        }

        if ($update) {
            return true;
        } else {
            return false;
        }
    }

    public function insertUser(string $user_name, string $user_email, string $user_password, $isAdmin): bool
    {
        $md5Password = md5($user_password);
        $newUser = $this->connection->query("insert into user (name, email, password, isAdmin)
values ('$user_name', '$user_email', '$md5Password', '$isAdmin');");

        return $newUser;
    }

    public function getUserById($id): bool|array|null
    {
        $user = $this->connection->query("select * from user where id = {$id}");
        if ($user->num_rows > 0) {
            return $user->fetch_assoc();
        }
        return null;
    }

    public function getAllUsers()
    {
        $allUsers = $this->connection->query("select * from user");
        if ($allUsers->num_rows > 0) {
            return $allUsers->fetch_all(MYSQLI_ASSOC);
        }
        return null;
    }

    public function getAvailableDays()
    {
        $allDays = $this->connection->query("select * from available_days");
        if ($allDays->num_rows > 0) {
            return $allDays->fetch_all(MYSQLI_ASSOC);
        }
        return null;
    }

    public function insertDay(string $dayWeek, string $owner): \mysqli_result|bool
    {
        $this->connection->query("
        insert into day(`owner`, `matchDay`) values('$owner', '$dayWeek')
        ");

        $insertedId = $this->getLastInsertedId();
        return $this->connection->query("
            INSERT INTO day_user(user, day) VALUES('{$owner}', '{$insertedId}') 
        ");

    }

    public function getAllDays()
    {
        $allDays = $this->connection->query("
        select `day`.id,
               available_days.code,
               available_days.id as 'day_id',
               available_days.name as 'day_name',
               `user`.id as 'user_id',
               `user`.name
        from `user` join day on `user`.id=day.owner join available_days on `day`.matchDay=available_days.id
        ");

        if ($allDays->num_rows > 0) {
            return $allDays->fetch_all(MYSQLI_ASSOC);
        }
        return null;
    }

    public function getActiveCourtsByUser($id)
    {
        $now = date("Y-m-d H:i:s");
        $courts = $this->connection->query("
        SELECT 
            c.id, c.datetime, c.isOpen, c.isScheduled, c.scheduleDatetime,
            ad.name as 'day_name', ad.code
        
        
        FROM court c JOIN day d on c.day = d.id JOIN user u on d.owner = u.id JOIN available_days ad on d.matchDay = ad.id 
        WHERE u.id = '{$id}' AND c.datetime >= '{$now}'
        ORDER BY c.datetime
        ");

        if ($courts->num_rows > 0) {
            return $courts->fetch_all(MYSQLI_ASSOC);
        }
        return null;
    }

    public function getAvailableCourtDaysByUser($id)
    {
        $availableDays = $this->connection->query("
        SELECT id, code, name
        FROM available_days 
        WHERE id IN
          (SELECT DISTINCT matchDay
           FROM day d
                JOIN user u on d.owner = u.id
            WHERE u.id = {$id})"
        );
        if ($availableDays->num_rows > 0) {
            return $availableDays->fetch_all(MYSQLI_ASSOC);
        }
        return null;
    }

    public function insertNewCourt(string $matchDay, $dateTime, $isOpen, $isSchedule, $scheduleDateTime, $maxPlayers, $owner): \mysqli_result|bool
    {
        $dayId = $this->connection->query("
        SELECT id FROM day WHERE owner='$owner' AND matchDay='$matchDay'
        ")->fetch_assoc()['id'];

        if ($isSchedule) {
            $insertedCourt = $this->connection->query("
            INSERT INTO court(day, datetime, isOpen, isScheduled, scheduleDatetime, max_Players)
            VALUES('$dayId','$dateTime', {$isOpen}, {$isSchedule}, '$scheduleDateTime', '$maxPlayers') 
            ");
        } else {
            $insertedCourt = $this->connection->query("
            INSERT INTO court(day, datetime, isOpen, isScheduled, max_Players)
            VALUES('$dayId', '$dateTime', {$isOpen}, {$isSchedule}, '$maxPlayers')
            ");
        }
        return $insertedCourt;
    }

    public function getLastInsertedId()
    {
        return $this->connection->insert_id;
    }

    public function getCourtInfo($courtId): bool|array|null
    {
        $courtData = $this->connection->query("
            SELECT c.datetime, c.isScheduled, c.isOpen, c.scheduleDatetime, c.max_Players,
                   ad.id as 'day_id', ad.code, ad.name,
                   d.owner
            FROM court c JOIN day d ON c.day=d.id JOIN available_days ad on d.matchDay = ad.id
            WHERE c.id='{$courtId}'");
        if ($courtData->num_rows > 0) {
            return $courtData->fetch_assoc();
        }
        return null;
    }

    public function updateCourt($matchDay, $dateInput, $isOpen, $isSchedule, $scheduleInput, $maxPlayers, $owner, $courtId)
    {
        $dayId = $this->connection->query("
        SELECT id FROM day WHERE owner='$owner' AND matchDay='$matchDay'
        ")->fetch_assoc()['id'];
        return $this->connection->query("
            UPDATE court SET day='{$dayId}',
                             datetime='{$dateInput}',
                             isOpen='{$isOpen}',
                             isScheduled='{$isSchedule}',
                             scheduleDatetime='{$scheduleInput}',
                             max_Players='{$maxPlayers}'
            WHERE id='{$courtId}'
            ");
    }

    public function updateDay($id, $ownerId, $dayWeekId)
    {
        return $this->connection->query("
        UPDATE day SET owner='{$ownerId}', matchDay='{$dayWeekId}' 
        WHERE id='{$id}'
        ");
    }

    public function getActiveCourts()
    {
        $now = date("Y-m-d H:i:s");
        return $this->connection->query("
            SELECT c.id, c.max_Players, c.datetime,
                   d.matchDay,
                   ad.code
                
            FROM court c JOIN day d ON c.day = d.id JOIN available_days ad ON d.matchDay = ad.id
            WHERE c.isOpen=1 AND c.datetime >= '{$now}'
            ORDER BY c.datetime
        ")->fetch_all(MYSQLI_ASSOC);

    }

    public function getHistoryCourts()
    {
        $now = date("Y-m-d H:i:s");
        return $this->connection->query("
            SELECT c.id, c.max_Players, c.datetime,
                   d.matchDay,
                   ad.name as 'day_name'

                
            FROM court c JOIN day d ON c.day = d.id JOIN available_days ad ON d.matchDay = ad.id
            WHERE c.isOpen=1 AND c.datetime < '{$now}'
            ORDER BY c.datetime DESC
        ")->fetch_all(MYSQLI_ASSOC);
    }

    public function insertPlayerIntoCourt($courtId, $playerId)
    {
        return $this->connection->query("
            INSERT INTO players_court(court, player) VALUES ('{$courtId}', '{$playerId}')
        ");
    }

    public function insertPlayer($playerName, $courtId)
    {
        $escapedPlayerName = $this->connection->escape_string($playerName);
        $maxPlayers = $this->connection->query("
            SELECT max_Players FROM court WHERE id='{$courtId}'
        ")->fetch_assoc()['max_Players'];

        $waitingList = 0;
        if ($this->getPlayerCountByCourtId($courtId)['player_count'] >= $maxPlayers) {
            $waitingList = 1;
        }

        $now = date('Y-m-d H:i:s');
        $this->connection->query("
            INSERT INTO players(name, isWaitingList, datetime_inserted) value('{$escapedPlayerName}', '{$waitingList}', '{$now}')
        ");

    }

    public function getPlayerCountByCourtId($courtId)
    {
        return $this->connection->query("
            SELECT COUNT(player) as 'player_count' 
            FROM players_court 
            JOIN players ON players_court.player = players.id
            WHERE court='{$courtId}' AND isWaitingList='0' AND isRemoved='0';
        ")->fetch_assoc();
    }

    public function getPlayerListByCourtId($courtId)
    {
        return $this->connection->query("
        SELECT 
                pc.id, pc.court, pc.player,
                p.id as 'player_id', p.name, p.datetime_inserted, p.isWaitingList, p.isRemoved, p.removedBy
        FROM players p JOIN players_court pc ON p.id = pc.player
        WHERE court='{$courtId}' AND isRemoved='0'
        ORDER BY p.datetime_inserted 
        ")->fetch_all(MYSQLI_ASSOC);
    }

    public function removePlayer($playerId, $removedBy): \mysqli_result|bool
    {
        return $this->connection->query(
            "UPDATE players SET isRemoved=1, removedBy='{$removedBy}' WHERE id='{$playerId}'"
        );
    }

    public function addPlayer($playerId): \mysqli_result|bool
    {
        return $this->connection->query(
            "UPDATE players SET isWaitingList=0 WHERE id='{$playerId}'"
        );
    }

    //region Cron
    public function getCourtsToOpen()
    {
        $query = "SELECT id, scheduleDatetime FROM court WHERE isScheduled = 1 AND isOpen = 0 AND scheduleDatetime <= NOW()";
        return $this->connection->query($query)->fetch_all(MYSQLI_ASSOC);
    }

    public function openCourtById($courtId)
    {
        $query = "UPDATE court SET isOpen=1 WHERE id={$courtId}";
        return $this->connection->query($query);
    }
    //endregion
}
