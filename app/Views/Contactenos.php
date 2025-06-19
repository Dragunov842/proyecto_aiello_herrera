<link href="<?php echo base_url('assets/css/placeholder.css') ?>" rel="stylesheet" type="text/css" />
<section class="contacto">
    <h2 class="title" style="color:white;">Contáctenos</h2>
    <p style="color:white; margin-top:50px;">
        3794-#######
    </p>
    <a href="https://www.google.com/maps/place/CAFETERÍA+LE+BLANC/..." class="mapa" style="margin-top:50px;">
        <img src="assets/img/mapa.png" alt="Mapa" width="500px" class="Mapa">
    </a>
</section>
            <section>
                <div class="form-group">
                    <label for="exampleFormControlInput1" style="font-size: 20px; color:white;">Correo Electrónico</label>
                    <input type="email" class="form-control negro" id="miInput2" style="background-color: white; color: black;" placeholder="Correo@ejemplo.com">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1" style="font-size: 20px; color:white;">Tipo Consulta</label>
                    <select class="form-control" id="miInput2" style="background-color: white; color: black;">
                        <option>Atención al Cliente</option>
                        <option>Consulta</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1" style="font-size: 20px; color:white;">Descripción</label>
                    <textarea class="form-control" id="miInput2" style="background-color: white; color: black;" placeholder="¿Cómo podemos ayudarte?" rows="3"></textarea>
                </div>
                <form action="<?= base_url('contactenos'); ?>">
                                <button type="submit" id="send_form" class="btn btn-success">Enviar</button>
                                <button type="reset" class="btn btn-danger">Cancelar</button>
                </form>
            </section>           