

<div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar sticky">
        <div class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
									collapse-btn"> <i data-feather="align-justify"></i></a></li>
            <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                <i data-feather="maximize"></i>
              </a></li>
            <li>
              <form class="form-inline mr-auto">
                <div class="search-element">
                  <input class="form-control" type="search" placeholder="Cherchez vous un employer 🥱? Tapez son nom ici..." aria-label="Search" data-width="370">
                  <button class="btn" type="button">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </form>
            </li>



          </ul>
        </div>
        
        <ul class="navbar-nav navbar-right">
          <li class="dropdown dropdown-list-toggle">
            <!-- <a href="#" data-toggle="dropdown"
              class="nav-link nav-link-lg message-toggle"><i data-feather="bell" class="bell"></i>
              <span class="badge headerBadge1">
                6 </span> </a> -->
            <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
              <div class="dropdown-header">
                Rapport réussi
                
              </div>
              <div class="dropdown-list-content dropdown-list-message">
              <a href="#" class="dropdown-item">
              <span class="dropdown-item-avatar text-white">
                <img alt="image" src="assets/img/users/user-1.png" class="rounded-circle">
              </span>
              <span class="dropdown-item-desc">
                <span class="message-user">John Deo</span>
                <span class="time messege-text">Please check your mail !!</span>
                <span class="time">2 Min Ago</span>
                <span class="badge badge-success ml-2">Côté</span> <!-- Ajout pour "Côté" -->
              </span>
            </a>

            <a href="#" class="dropdown-item">
              <span class="dropdown-item-avatar text-white">
                <img alt="image" src="assets/img/users/user-2.png" class="rounded-circle">
              </span>
              <span class="dropdown-item-desc">
                <span class="message-user">Jane Smith</span>
                <span class="time messege-text">New update is available now!</span>
                <span class="time">5 Min Ago</span>
                <span class="badge badge-danger ml-2">Non Côté</span> <!-- Ajout pour "Non Côté" -->
              </span>
            </a>

              </div>
              <div class="dropdown-footer text-center">
                <a href="#">Voir tout<i class="fas fa-chevron-right"></i></a>
              </div>
            </div>
          </li>

          <li class="dropdown"><a href="#" data-toggle="dropdown"
              class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image" src="assets/img/user.png"
                class="user-img-radious-style"> <span class="d-sm-none d-lg-inline-block"></span></a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
              <div class="dropdown-title">Hello <?php echo $_SESSION['nom'] ?>.</div>
              <!-- <a href="#" class="dropdown-item has-icon"> <i class="far
										fa-user"></i> Profile
              </a> <a href="#" class="dropdown-item has-icon"> <i class="fas fa-bolt"></i>
                Activities
              </a>  -->
             
              <?php
              
                  if($_SESSION['type'] == "Admin"){

              ?>
               <a href="admin" class="dropdown-item has-icon"> <i class="fas fa-cog"></i>
                Enregistrement Back
              </a>
              <a href="privilege" class="dropdown-item has-icon"><i class="fas fa-cogs"></i>
                Privilege
              </a>
              <?php } ?>
              <div class="dropdown-divider"></div>
              <a href="deconnexion" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>

      </nav>


      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="home"> <img alt="image" src="assets/img/logo.png" class="header-logo" /> <span
                class="logo-name">SkillSyncro</span>
            </a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <!-- <li class="dropdown active">
              <a href="dashbord" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li> -->
            <li class="dropdown active">
              <a href="home" class="nav-link"><i data-feather="monitor"></i><span>Dashboard | Côtation</span></a>
            </li>
           
          
           
            <?php
              
                  if($_SESSION['type'] == "Admin"){

              ?>
            <li class="dropdown">
              <a href="add-data" class="nav-link"><i data-feather="monitor"></i><span>Enregistrement</span></a>
            </li>
            <?php } ?>
            <li><a class="nav-link" href="statistique-du-jour"><i data-feather="file"></i><span>Impression | Stat du jour</span></a></li>
          <!-- <li class="dropdown">
              <a href="#" class=""><i data-feather="user-check"></i><span>Statistique</span></a>
             
            </li>
            -->
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i
                  data-feather="user-check"></i><span>Statistique</span></a>
              <ul class="dropdown-menu">
                <!-- <li><a class="nav-link" href="les-etapes-de-la-statistique">Annuel</a></li>
                <li><a class="nav-link" href="les-etapes-de-la-statistique">Trimestriel</a></li> -->
                <li><a class="nav-link" href="les-etapes-de-la-statistique">Mensuel</a></li>
                <li><a class="nav-link" href="semaine-employer">Semestriel</a></li>
              </ul>
            </li>
           
          </ul>
        </aside>
      </div>