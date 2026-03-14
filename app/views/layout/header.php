<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?php echo isset($title) ? htmlspecialchars($title) : 'Plataforma EDU'; ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <div class="container-fluid">
      <a class="navbar-brand" href="/">EDURO</a>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link" href="/">Inicio</a></li>
          <?php if (isset($_SESSION['user'])): ?><li class="nav-item"><a class="nav-link" href="/logout">Cerrar sesión</a></li><?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>
