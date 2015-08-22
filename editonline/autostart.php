<?php

Yii::app()->moduleManager->register(array(
    'id' => 'editonline',
    'class' => 'application.modules.editonline.EditOnline',
    'import' => array(
        'application.modules.editonline.*',
    ),
    'events' => array(
        array('class' => 'TopMenuWidget', 'event' => 'onInit', 'callback' => array('EditOnlineEvents', 'onTopMenuInit')),
    ),
));
?>