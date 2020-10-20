<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//Enviar lista de imagenes respaldadas
echo json_encode(array_chunk(scandir(FEMORA_COMPRESS_UPLOAD_PATH.'/femora_respaldo'),800));