<?php
/* @var $this yii\web\View */

$this->title = Yii::$app->name;
?>
<div class="site-index">
    <div class="row">
        <div class="col">
            <div id="server-date" class="date-index"></div>
            <div id="server-time" class="time-index"><h1></h1></div>
        </div>
    </div>
</div>
<?php
$js = <<< JS
function az(i) {if (i<10) {i = "0" + i};return i;}
var started_at = new Date().getTime();
var server_time = new Date().getTime();
var clockInterval = setInterval(function(){
    var current_time = new Date().getTime();
    var s = new Date(server_time + current_time - started_at);
    document.getElementById('server-date').innerHTML = az(s.getDate())+'/'+az(s.getMonth()+1)+'/'+s.getFullYear();
    document.getElementById('server-time').innerHTML = az(s.getHours())+':'+az(s.getMinutes())+':'+az(s.getSeconds());
}, 1000)
JS;
$this->registerJs($js, \yii\web\View::POS_END)
?>
