<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Nuevo servicio</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel="stylesheet" href="css/formulario.css">
</head>
<body>
  <h1>Crear un nuevo servicio.</h1>
  <form class="cf">
    <div class="half left cf">
      <input type="text" name="nombre" id="input-name" placeholder="Nombre servicio">
      <input type="number" name="recursos" id="input-recursos" placeholder="Recursos" min="0">
      <input type="date" name="inicio" id="input-inicio" placeholder="Fecha inicio">
      <select class="" name="cliente">
        <option value="" selected style="color:gray">Cliente</option>
        <option value="">FORD</option>
      </select>
      <input type="text" name="responsable" id="input-responsable" placeholder="Responsable">
      <input type="tel" name="tel" id="input-tel" placeholder="Telefono">
      <input type="email" name="email" id="input-email" placeholder="Correo">
    </div>
    <div class="half right cf">
      <textarea name="supervisor" type="text" id="input-message" placeholder="Comentario para el supervisor"></textarea>
      <textarea name="rrhh" type="text" id="input-message" placeholder="Comentario para RRHH"></textarea>
      <textarea name="adminfin" type="text" id="input-message" placeholder="Comentario para el Admin. financiero"></textarea>
    </div>
    <input type="submit" value="Crear" id="input-submit">
  </form>
</body>
</html>
