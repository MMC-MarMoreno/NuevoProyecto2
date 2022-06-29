<?php include("template/cabecera.php");?>

<div class="container">

    <form class="my-form">
        <div class="container">
          <h1>Formulario de Contacto</h1>
          <ul class="ul-none">
            <li>
              <select>
                <option selected disabled>-- Selecciona una opción --</option>
                <option>Presupuestos</option>
                <option>Registro</option>
                <option>Privacidad de Datos</option>   
                <option>Finalidad</option>
                <option>Mejoras</option>  
                <option>Otros</option> 
              </select>
            </li>
            <li>
              <div class="grid grid-2">
                <input type="text" placeholder="Nombre" required>  
                <input type="text" placeholder="Apellidos" required>
              </div>
            </li>
            <li>
              <div class="grid grid-2">
                <input type="email" placeholder="Email" required>  
                <input type="tel" placeholder="Teléfono">
              </div>
            </li>    
            <li>
              <textarea placeholder="Mensaje"></textarea>
            </li>   
            <li>
              <input type="checkbox" id="terms">
              <label for="terms">Acepto la política de privacidad.</label>
            </li>  
            <li>
              <div class="grid grid-3">               
                <button class="btn-grid" type="submit" enabled>
                  <span class="back">
                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/162656/email-icon.svg" alt="">
                  </span>
                  <span class="front">Enviar</span>
                </button>
                <button class="btn-grid" type="reset" enabled>
                  <span class="back">
                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/162656/eraser-icon.svg" alt="">
                  </span>
                  <span class="front">Borrar</span>
                </button> 
                </div>
                <div>
                <br>
                <h3>Política de Privacidad</h3>
                *Los datos enviados, solo se utilizarán para contestar a las dudas o sugerencias enviadas desde el apartado de Contacto. <br/>
                *No se mandará a otros ningún dato de contacto.
              </div>
            </li>    
          </ul>
        </div>
      </form>  
</div>   


<?php include("template/pie.php");?> 