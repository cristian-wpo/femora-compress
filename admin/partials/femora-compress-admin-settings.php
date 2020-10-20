<?php
function femora_configuracion()
{
    global $wpdb;

    /*
 * Obtener configuración Femora desde la base de datos
 */
    if (get_option('_femora_web_token')) {
        $femoratoken = get_option('_femora_web_token');
        $femorafolder = get_option('_femora_folder_code');
        //echo $femorafolder.'token';
    } else {
        $femoratoken = 'null';
        //echo 'null';
    }
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
        <div class="boxsFourColumns">
            <div class="widget" id="width1">
                <?php
                if ($femoratoken == 'null' or $femoratoken == 'off') {
                    echo '<h2>Sign In</h2>
                            <form>
                                <div class="field">
                                    <input id="input-usuario" type="text" class="username" name="username" placeholder="Username" value=""/>
                                </div>
                                <div class="field">
                                    <input id="input-password" type="password" class="password" name="password" placeholder="Password" value=""/>
                                </div>
                                <ul class="inline-list">
                                    <li>
                                        <input id="btn_registro" readonly="readonly" class="femora_boton" value="Registrarte" onclick="femora_registro()"/>
                                    </li>
                                    <li>
                                        <a id="text-buton-gtoken" class="btn_white" onclick="text_buton_gtoken()">Login</a>
                                    </li>
                                </ul>
                            </form>';
                } else {
                    echo "<input id=\"btn_registro\" readonly=\"readonly\" class=\"femora_boton\" value=\"Desconectar\" onclick=\"femora_desconectar()\"/>";
                }
                ?>
            </div>
            <div class="widget"></div>
            <div class="widget">
                <!-- <h2>SUSCRIBITE PARA OBTENER TUTORIALES, OFERTAS Y RECOMENDACIONES</h2>
                <form>
                    <div class="field">
                        <input type="text" name="email" />
                    </div>
                    <div class="field">
                        <input type="submit" value="Suscribirse" />
                    </div> -->
                </form>
            </div>
            <div class="widget" id="width4">
                <h2>RESTAURAR IMAGENES ORIGINALES</h2>
                <div class="progress-wrapper">
                    <div id="progress_restaurar"></div>
                </div>


                <form>
                    <div class="field">
                        <input id="btn_respaldo" readonly="readonly" class="femora_boton" value="Restaurar" onclick="obtener_lista_respaldo()" />
                    </div>
                </form>
            </div>
        </div>
        <!-- <div class="BxDetallesFormatos">
            <div class="widget">
                <h3>PNG</h3>
                <ul>
                    <li>
                        <label>SPEED</label>
                        <input class="opciones-imagenes-png" type="text" />
                    </li>
                    <li>
                        <label>STRIP</label>
                        <input class="opciones-imagenes-png" type="text" />
                    </li>
                    <li>
                        <label>QUALITY</label>
                        <input class="opciones-imagenes-png" type="text" />
                    </li>
                    <li>
                        <label>DITHERING</label>
                        <input class="opciones-imagenes-png" type="text" />
                    </li>
                    <li>
                        <label>POSTERIZE</label>
                        <input class="opciones-imagenes-png" type="text" />
                    </li>
                    <li>
                        <label>VERBOSE</label>
                        <input class="opciones-imagenes-png" type="text" />
                    </li>
                    <li>
                        <label>INPUT</label>
                        <input class="opciones-imagenes-png" type="text" />
                    </li>
                </ul>
            </div>
            <div class="widget">
                <h3>JPG</h3>
                <ul>
                    <li>
                        <label>QUALITY</label>
                        <input type="text" />
                    </li>
                    <li>
                        <label>PROGRESIVE</label>
                        <input type="text" />
                    </li>
                    <li>
                        <label>TARCA</label>
                        <input type="text" />
                    </li>
                    <li>
                        <label>REVERT</label>
                        <input type="text" />
                    </li>
                    <li>
                        <label>FASTCRUSH</label>
                        <input type="text" />
                    </li>
                    <li>
                        <label>DCSCANOPT</label>
                        <input type="text" />
                    </li>
                    <li>
                        <label>TRELLIS</label>
                        <input type="text" />
                    </li>
                    <li>
                        <label>TRELLISDC BOOLEAN</label>
                        <input type="text" />
                    </li>
                    <li>
                        <label>TUNE</label>
                        <input type="text" />
                    </li>
                    <li>
                        <label>OVERSHOT</label>
                        <input type="text" />
                    </li>
                    <li>
                        <label>ARITHMETIC</label>
                        <input type="text" />
                    </li>
                    <li>
                        <label>DCT</label>
                        <input type="text" />
                    </li>
                    <li>
                        <label>QUANTBASELINE</label>
                        <input type="text" />
                    </li>
                    <li>
                        <label>QUANTABLE</label>
                        <input type="text" />
                    </li>
                    <li>
                        <label>SMOOTH</label>
                        <input type="text" />
                    </li>
                    <li>
                        <label>MAXMEMORY</label>
                        <input type="text" />
                    </li>
                    <li>
                        <label>SAMPLE</label>
                        <input type="text" />
                    </li>
                    <li>
                        <label>BUFFER</label>
                        <input type="text" />
                    </li>
                </ul>
            </div>
            <div class="widget">
                <h3>WEBP</h3>
                <ul>
                    <li>
                        <label>PRESET</label>
                        <input type="text" />
                    </li>
                    <li>
                        <label>QUALITY</label>
                        <input type="text" />
                    </li>
                    <li>
                        <label>ALPHAQUALITY</label>
                        <input type="text" />
                    </li>
                    <li>
                        <label>METHOD</label>
                        <input type="text" />
                    </li>
                    <li>
                        <label>SIZE</label>
                        <input type="text" />
                    </li>
                    <li>
                        <label>SNS</label>
                        <input type="text" />
                    </li>
                    <li>
                        <label>FILTER</label>
                        <input type="text" />
                    </li>
                    <li>
                        <label>AUTOFILTER</label>
                        <input type="text" />
                    </li>
                    <li>
                        <label>SHARPNESS</label>
                        <input type="text" />
                    </li>
                    <li>
                        <label>LOSSLESS</label>
                        <input type="text" />
                    </li>
                    <li>
                        <label>NEARLOSLESS</label>
                        <input type="text" />
                    </li>
                    <li>
                        <label>CROP</label>
                        <input type="text" />
                    </li>
                    <li>
                        <label>RESIZE</label>
                        <input type="text" />
                    </li>
                    <li>
                        <label>METADADA</label>
                        <input type="text" />
                    </li>
                    <li>
                        <label>BUFFER</label>
                        <input type="text" />
                    </li>
                </ul>
            </div>

        </div> -->
    </div>
<?php
}
