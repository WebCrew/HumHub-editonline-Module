<?php

/**
 * EditOnlineEvents is responsible to handle events defined by autostart.php
 *
 * @author Andreas Holzer
 */
class EditOnlineEvents
{

    /**
     * On build of the TopMenu
     *
     * @param CEvent $event
     */
    public static function onTopMenuInit($event)
    {
        $event->sender->addItem(array(
            'label' => Yii::t('EditOnline.base', 'Edit Online'),
            'url' => Yii::app()->createUrl('/editonline/main/index', array()),
            'icon' => '<i class="fa fa-cogs"></i>',
            'isActive' => (Yii::app()->controller->module && Yii::app()->controller->module->id == 'editonline'),
        ));
    }

}
