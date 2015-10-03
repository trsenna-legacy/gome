<?php

namespace back\components\bootstrap;

use Yii;
use yii\base\Widget;
use yii\bootstrap\Alert;

class DashboardAlert extends Widget
{
    public function run()
    {
        $this->renderFlash( 'success' );
        $this->renderFlash( 'info' );
        $this->renderFlash( 'warning' );
        $this->renderFlash( 'danger' );
    }

    private function renderFlash( $key )
    {
        if ( Yii::$app->session->hasFlash( $key ) ) {
            Alert::begin( [
                'options' => [
                    'class' => "alert-$key",
                ],
            ] );

            echo '<ul>';

            $alerts = Yii::$app->session->getFlash( $key );
            $alerts = is_array( $alerts ) ? $alerts : [ $alerts ];
            foreach ( $alerts as $alert ) {
                echo "<li>$alert</li>";
            }

            echo '</ul>';

            Alert::end();
        }
    }
}