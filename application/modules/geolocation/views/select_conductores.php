               <div class="col-xs-6">
                   <select id="conductor_servicio" class="form-control">
                     <option value="">Seleccion Conductor</option>
                    <?php foreach ($this->conductores as $r): ?>
                    <option value="<?= $r->id_Usuarios ?>"><?= "$r->Usuarios_nombre $r->Usuarios_apellido" ?></option>
                    <?php endforeach ?>
                 </select>
               </div>

                <div class="col-xs-2" style="margin-bottom: 10px">
                    <button class="btn btn-success" onclick="confirm('Desea solicitar el servicio?') && solicitar_servicio()" >Solicitar Servicio</button>
               </div>