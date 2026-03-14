<div class="container">
  <div class="row">
    <div class="col-12">
      <h1>Dashboard</h1>
      <p>Bienvenido: <?php echo isset($user['email']) ? htmlspecialchars($user['email']) : 'Invitado'; ?></p>
    </div>
  </div>
</div>
