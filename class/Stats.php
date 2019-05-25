<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018-12-22
 * Time: 18:52
 */

    class Stats{

        public static function moyenne($tab){
            if (array_sum($tab) != 0) {
                return round(array_sum($tab) / sizeof($tab),2);
            }
        }

        public static function pourcentage($valeur,$total){
            if (is_array($total)) {
                return round(($valeur / array_sum($total)) * 100, 2);
            }if (is_numeric($total)){
                return round(($valeur / $total) * 100, 2);
            }
        }

        public static function titulaireChart($id_canvas,$nbTitulaire, $nbRemplacant){
            echo "<canvas id=\"$id_canvas\" width=\"600\" height=\"100\"></canvas>
                    <script>";
            echo "var ctx = document.getElementById(\"$id_canvas\");
                    var myChart = new Chart(ctx, {
                        type: 'horizontalBar',
                        data: {
                            labels: [\"Titulaire\", \"Remplaçant\"],
                            datasets: [{
                                label: '# de titularisation',
                                data: [$nbTitulaire,$nbRemplacant],
                                backgroundColor: [
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                                scales: {
                                    yAxes: [{
                                        position: 'right',
                                    }],
                                    xAxes: [{
                                        ticks: {
                                            beginAtZero:true,
                                            min:0,
                                            max: Math.max($nbTitulaire, $nbRemplacant)+2,
                                            stepSize: 1
                                        }
                                    }]
                                }
                            }
                    });";
            echo "</script>";
        }

        public static function moyenneNoteChart($id_canvas,$tab_notes,$tab_date){
            $tab_data= '[';
            foreach($tab_notes as $note){
                $tab_data .= $note.',';
            }$tab_data.= ']';
            $tab_label = '[';
            foreach($tab_date as $label){
                $tab_label .= '"'.$label.'",';
            }$tab_label .= ']';
            echo "<canvas id=\"$id_canvas\" width=\"400\" height=\"100\"></canvas>
                    <script>";
            echo "var ctx = document.getElementById(\"$id_canvas\");
                    var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: $tab_label,
                            datasets: [{
                                label: 'Note sur 5 ',
                                data: $tab_data,
                                fill: false,
                                borderColor: [
                                    'rgba(255, 159, 64, 1)'
                                ],
                                lineTension:0.1
                            }]
                        },
                        options: {
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero:true,
                                            min:0,
                                            max:5,
                                            stepSize: 1
                                        }
                                    }]
                                }
                            }
                    });";
            echo "</script>";
        }

        public static function pourcentageMatchsGagnesChart($id_canvas,$nb_matchs_gagnes,$nb_matchs_total)
        {
            $pourcentageGagnes = round(($nb_matchs_gagnes / $nb_matchs_total) * 100, 2);
            $pourcentagePerdant = round(100 - $pourcentageGagnes, 2);
            echo "<canvas id=\"$id_canvas\" width=\"70\" height=\"10\"></canvas>
                    <script>";
            echo "var ctx = document.getElementById(\"$id_canvas\");
                        new Chart(ctx,  {
                            type:'doughnut',
                            data:   {
                                    labels:[\"% de matchs gagnés\",\"% de matchs perdus\"],
                                    datasets:   [{
                                        label:  \"My First Dataset\",
                                        data:[$pourcentageGagnes,$pourcentagePerdant],
                                        backgroundColor:[\"rgb(154, 205, 50)\",\"rgb(220, 20, 60)\"]
                                        }]
                                    },
                            options: {
                                legend: {
                                    position: 'right'
                                }
                            }
                                }
                            );
                ";
            echo "</script>";
        }


    }