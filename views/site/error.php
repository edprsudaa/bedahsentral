<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<!-- Flash -->
<!-- <style>
  body {
    font-family: Arial, sans-serif;
    background-color: #333;
    margin: 0;
    padding: 0;
    /* display: flex;
    justify-content: center;
    align-items: center; */
    height: 100vh;
  }

  .error-container {
    text-align: center;
    background-color: #f44336;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    animation: flash 1s ease-in-out infinite;
  }

  @keyframes flash {

    0%,
    50%,
    100% {
      opacity: 1;
    }

    25%,
    75% {
      opacity: 0;
    }
  }

  .error-code {
    font-size: 72px;
    color: #fff;
  }

  .error-message {
    font-size: 24px;
    color: #fff;
  }

  .back-button {
    background-color: #f44336;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    margin-top: 20px;
  }

  .back-button:hover {
    background-color: #d32f2f;
  }
</style> -->
<!-- Putar -->
<style>
  body {
    /* font-family: Arial, sans-serif; */
    background-color: #333;
    margin: 0;
    padding: 0;
    /* display: flex;
    justify-content: center;
    align-items: center; */
    height: 100vh;
  }

  .error-container {
    text-align: center;
    /* background-color: #f44336; */
    background-color: #dc3545;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    animation: flashAndColorChange 1s ease-in-out infinite;
  }

  @keyframes flashAndColorChange {

    0%,
    100% {
      /* background-color: #f44336; */
      background-color: #dc3545;
      color: #fff;
    }

    50% {
      background-color: #fff;
      /* color: #f44336; */
      color: #dc3545;
    }
  }

  .error-code {
    font-size: 72px;
  }

  .error-message {
    font-size: 24px;
  }

  .back-button {
    background-color: #f44336;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    margin-top: 20px;
  }

  .back-button:hover {
    background-color: #d32f2f;
  }
</style>

<div class="site-error">

  <div class="error-container">
    <div class="error-code"><?= Html::encode($this->title) ?></div>
    <div class="error-message"><?= nl2br(Html::encode($message)) ?></div>
    <button class="back-button" onclick="goBack()">Kembali</button>
  </div>

  <script>
    function goBack() {
      window.history.back();
    }
  </script>

</div>