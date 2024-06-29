<?php
require_once __DIR__ . "/../../../vendor/autoload.php";

use app\controllers\MainController;
use app\database\entyties\User;
use app\models\UserModel;

$request = new app\http\Request;

/* "revivendo" a variável de sessão */
if (!isset($_SESSION)) {
    session_start();
}

if (isset($request->getQueryParams()["session_destroy"])) {
    MainController::logout(session_destroy: true);
}

if (isset($_SESSION["id"]) || isset($_SESSION["user"])) {
    $user = User::fromArray($_SESSION["user"]);
    $pahtToProfileImage =
        UserModel::getPahtToProfileImage($user) ?? sprintf("../public/assets/%s.png", ucfirst(substr($user->getName(), 0, 1)));
} else {
    die("Você não pode acessar essa página, pois não está logado. Faça o login <a href='/login'>fazer login</a>");
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../public/assets/logo.png">
    <link rel="stylesheet" href="../public/css/style.css">
    <link rel="stylesheet" href="../public/css/sensors.css">
    <link rel="stylesheet" href="../public/css/header.css">
    <link rel="stylesheet" href="../public/css/menu-mobile.css">
    <link rel="stylesheet" href="../public/css/sidebar.css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />
    <script rel="preconnect" src="https://kit.fontawesome.com/638bd1bffb.js" crossorigin="anonymous"></script>
    <title>ENOSE REMOTE - SENSORS</title>
</head>

<body>
    <?php include_once "../../resources/components/header.php" ?>

    <?php include_once "../../resources/components/menu-mobile.php" ?>

    <div class="contain">
        <?php include_once "../../resources/components/sidebar.php" ?>

        <main>
            <div class="sensor" id="mq3">
                <div class="sensor-header">
                    <h2 id="name-sensor">MQ3</h2>
                </div>
                <!--                 <div class="sensor-body">
                    <p>
                        O módulo MQ-3 é adequado para detectar álcool, benzina, CH4, hexano, GLP, CO. O material sensível do sensor de gás MQ-3 é o SnO2, que possui menor condutividade em ar limpo, quando o gás álcool é detectado, a condutividade
                        do sensor é mais alta, juntamente com o aumento da concentração de gás. O sensor de gás MQ-3 tem alta sensibilidade ao álcool e boa resistência a perturbações da gasolina, fumaça e vapor. Este sensor fornece uma saída resistiva
                        analógica com base na concentração de álcool.
                    </p>

                </div>
 -->
                <div class="sensor-footer">
                    <div id="chart-mq3"></div>
                </div>
            </div>

            <div class="sensor" id="mq5">
                <div class="sensor-header">
                    <h2 id="name-sensor">MQ5</h2>
                </div>
                <!--                 <div class="sensor-body">
                    <p>
                        O Sensor de Gás MQ-5 possuí alta sensibilidade para detecção de Gás GLP (Gás de cozinha), Gás natural e Gás de carvão, além de possuir baixa sensibilidade para detecção de álcool e fumaça de cigarro. Com resposta rápida, vida de
                        longa duração e acionamento simples, o sensor de gás MQ-5 é uma ótima opção para projetos de detecção de presença dos citados. O sensor em questão possui a saída digital DO que altera seu estado lógico conforme o ajuste realizado
                        no potenciômetro, tornando possível o acionamento direto de um relé ou do microcontrolador. Outrossim, o sensor conta com a saída analógica AO, que possibilita a medição de concentração com base na variação de tensão.
                    </p>
 
                </div>
 -->
                <div class="sensor-footer">
                    <div id="chart-mq5">
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script type="module" src="../public/js/index.js"></script>
    <script src="../public/js/sensors-chart.js"></script>
</body>

</html>