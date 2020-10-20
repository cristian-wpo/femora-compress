<?php
function femora_backend_dashboard()
{
    global $wpdb;

    /*
     * Get Femora configuration from database
     */

    $alturamax = 2500;
    if (!get_option('_femora_altura_maxima')) {
        add_option('_femora_altura_maxima', '2500', '', 'no');
    } else {
        $alturamax = get_option('_femora_altura_maxima');
    }

    $anchuramax = 2500;
    if (!get_option('_femora_anchura_maxima')) {
        add_option('_femora_anchura_maxima', '2500', '', 'no');
    } else {
        $anchuramax = get_option('_femora_anchura_maxima');
    }

    $respaldo = 'no';
    if (!get_option('_femora_crear_respaldo')) {
        add_option('_femora_crear_respaldo', 'no', '', 'no');
    } else {
        $respaldo = get_option('_femora_crear_respaldo');
    }

    $convertir_webp = 'no';
    if (!get_option('_femora_convertir_webp')) {
        add_option('_femora_convertir_webp', 'no', '', 'no');
    } else {
        $convertir_webp = get_option('_femora_convertir_webp');
    }
    /*
     * Fin obtener configuración Femora desde la base de datos
     */

?>
    <div class="box_custom_femora">
        <div class="topLogoBanner">
            <div class="logo">
                <img src="<?= FEMORA_COMPRESS_DIR_URL; ?>assets/images/logo-femora.png" alt="Femora" />
            </div>
            <div class="banner">
                <img src="<?= FEMORA_COMPRESS_DIR_URL; ?>assets/images/banner-femora.png" alt="Femora" />
            </div>
        </div>
        <div class="boxsTwoColumns">
            <div class="widget">
                <div class="top">
                    <ul class="inline-list">
                        <li>
                            <span class="icon-jpg"></span>
                            <span class="icon-png"></span>
                        </li>
                        <li>
                            <div class="btn_buscar">
                                <button type="button" id="burcar-imagenes" class="buscar btn_femora" onclick="femora_buscarimagenes();">
                                    Search Images
                                </button>
                            </div>
                        </li>
                        <li>
                            <span id="imagenes-encontradas">Images found</span>
                        </li>
                    </ul>
                </div>
                <div class="bottom">
                    <ul class="inline-list">
                        <li class="bxProgressBar">
                            <div class="demo-wrapper">
                                <div id="femora_progress"></div>
                            </div>

                        </li>
                        <li>
                            <div class="btn_optimizar">
                                <button type="button" class="optimizar btn_femora" onclick="optimizarimagenesescritorio();">
                                    Optimize
                                </button>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="widget">
                <h3 class="title">
                    <span>Setting</span>
                    <span class="iconO"></span>
                </h3>
                <div>
                    <ul class="inline-list">
                        <li>
                            <strong>Max Heigth</strong>
                            <input type="text" id="alturamaxima" value="<?php
                                                                        if ($alturamax != 'null') {
                                                                            echo $alturamax;
                                                                        } else {
                                                                            echo 2024;
                                                                        }
                                                                        ?>" />
                        </li>
                        <li>
                            <strong>Max Width</strong>
                            <input type="text" id="anchuramaxima" value="<?php
                                                                            if ($anchuramax != 'null') {
                                                                                echo $anchuramax;
                                                                            } else {
                                                                                echo 2024;
                                                                            }
                                                                            ?>" />
                        </li>
                    </ul>
                </div>
                <div>
                    <ul class="inline-list">
                        <li>
                            <label><input type="checkbox" id="femora-respaldo" value="first_checkbox">Create backup</label>
                        </li>
                        <li>
                            <label><input type="checkbox" id="femora-convertir-webp" value="second_checkbox">PNG and JPEG to WebP</label>
                        </li>
                    </ul>
                </div>
                <div>
                    <div class="bxInfo">
                        <label id="femora-p-diferencia">Total Weight: <strong></strong> New Weight: <strong></strong></label>
                    </div>
                </div>
            </div>
        </div>
        <div class="listaImagenes">
            <table id="tablafemoracompress" class="femora-tabla display" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <!--<th>OPTIMIZAR</th>-->
                        <th>NAME </th>
                        <th>FORMAT</th>
                        <th>PREVIOUS WEIGHT</th>
                        <th>NEW WEIGHT</th>
                        <th>COMPARE</th>
                        <th>SAVED</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <!--<th>OPTIMIZAR</th>-->
                        <th>NAME </th>
                        <th>FORMAT</th>
                        <th>PREVIOUS WEIGHT</th>
                        <th>NEW WEIGHT</th>
                        <th>COMPARE</th>
                        <th>SAVED</th>
                    </tr>
                </tfoot>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <div id="ex1" class="modal">
        <div class="row" style="margin-top: 2em;">
            <div class="large-12 columns">
                <div class="twentytwenty-container">
                    <img id="femoracompara1" src="">
                    <img id="femoracompara2" src="">
                </div>
            </div>
        </div>
        <a href="#" rel="modal:close">CLOSE</a>
    </div>
<?php
    /*
 * Marcar el check del respaldo como activo o no
 */
    if ($respaldo == 'si') {
        echo '<script>jQuery("#femora-respaldo").prop("checked", true);</script>';
    } else {
        echo '<script>jQuery("#femora-respaldo").prop("checked", false);</script>';
    }
    /*
 * Marcar el check del WebP como activo o no
 */
    if ($convertir_webp == 'si') {
        echo '<script>jQuery("#femora-convertir-webp").prop("checked", true);</script>';
    } else {
        echo '<script>jQuery("#femora-convertir-webp").prop("checked", false);</script>';
    }
}
