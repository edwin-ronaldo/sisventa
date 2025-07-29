<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="http://localhost/sisventas">Home</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
    
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="archivosDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Archivos
          </a>
          <ul class="dropdown-menu" aria-labelledby="archivosDropdown">
            <li><a class="dropdown-item" href="http://localhost/sisventas/vista/producto/listado.php">Productos</a></li>
            <li><a class="dropdown-item" href="http://localhost/sisventas/vista/cliente/listado.php">Clientes</a></li>
            <li><a class="dropdown-item" href="http://localhost/sisventas/vista/proveedor/listado.php">Proveedores</a></li>
            <li><a class="dropdown-item" href="http://localhost/sisventas/vista/categoria/listado.php">Categorías</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="http://localhost/sisventas/vista/usuario/listado.php">Usuarios</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="procesosDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Procesos
          </a>
          <ul class="dropdown-menu" aria-labelledby="procesosDropdown">
            <li><a class="dropdown-item" href="http://localhost/sisventas/vista/venta/registrar.php">Registrar Ventas</a></li>
            <li><a class="dropdown-item" href="http://localhost/sisventas/vista/venta/listado.php">Listado de Ventas</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="consultasDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Consultas
          </a>
          <ul class="dropdown-menu" aria-labelledby="consultasDropdown">
            <li><a class="dropdown-item" href="http://localhost/sisventas/vista/consulta/stock.php">Stock Productos</a></li>
            <li><a class="dropdown-item" href="http://localhost/sisventas/vista/consulta/ventas_fecha.php">Ventas por Fecha</a></li>
            <li><a class="dropdown-item" href="http://localhost/sisventas/vista/consulta/ventas_cliente.php">Ventas por Cliente</a></li>
            <li><a class="dropdown-item" href="http://localhost/sisventas/vista/consulta/ventas_producto.php">Ventas por Producto</a></li>
            <li><a class="dropdown-item" href="http://localhost/sisventas/vista/consulta/ranking.php">Ranking Ventas</a></li>
          </ul>
        </li>
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>   