<?php

require_once 'Payment.php';
require_once 'Scheduler.php';
require_once 'PaymentsCalculator.php';




$scheduler = new Scheduler(3, new DateTime(''));

$paymentsCalculator = new PaymentsCalculator($scheduler);

//print_r($paymentsCalculator);





