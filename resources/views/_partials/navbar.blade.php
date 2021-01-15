<nav class="navbar is-dark" role="navigation" aria-label="dropdown navigation">

  <div class="navbar-brand">
    <a class="navbar-item" href="/">
      CRUD Laravel
    </a>
    <a role="button" class="navbar-burger has-text-light" data-target="navMenu" aria-label="menu" aria-expanded="false">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>

  <div class="navbar-menu" id="navMenu">
    <div class="navbar-start">
    <span class="navbar-item">
        Cinema
      </span>
    </div>
    <div class="navbar-end">
      
      <a href="/" class="navbar-item">
        Inicio
      </a>

      <!-- Catálogos -->
      <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link">
          Catálogos
          <span class="icon is-medium is-hidden-desktop">
            <i class="fas fa-chevron-down"></i>
          </span>
        </a>

        <div class="navbar-dropdown is-hidden-touch is-right">
        
        <a href="{!! route('movies.index') !!}" class="navbar-item">
        Películas
        </a>
        
        <a href="{!! route('actors.index') !!}" class="navbar-item">
        Actores
        </a>
        
        <a href="{!! route('directors.index') !!}" class="navbar-item">
        Directores
        </a>
        </div>

      </div>
    </div>

</div>
</nav>
