<?php
 interface iSessionValidation {const START_TIME_KEY = 'starttime';public function startActiveTime();public function endActiveTime();public function isActiveTimeExpired();public function getActiveTime();public function getMaxActiveTime();}