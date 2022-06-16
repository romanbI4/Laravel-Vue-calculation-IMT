<h2>Расчет!</h2>

<?php
use Symfony\Component\Console\Input\Input;

echo Form::open(array('url' => '/calculations','POST'));

echo Form::label('weight', 'Ваш Вес') . Form::number('weight', 'вес в кг', ['step' => '0.01']);
echo Form::label('height', 'Ваш рост') . Form::number('height', 'рост в м', ['step' => '0.01']);

echo Form::submit('Расчет!');

echo Form::token() . Form::close();
?>

<p>Ваш ИМТ: {{ $calc ?? '' }}</p>