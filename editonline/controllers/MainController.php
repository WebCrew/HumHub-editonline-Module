<?php

/**
 * MainController shows the editonline page
 *
 * @author Andreas Holzer
 */
class MainController extends Controller
{

    public function actionIndex()
    {
        $this->render('index');
    }

}
