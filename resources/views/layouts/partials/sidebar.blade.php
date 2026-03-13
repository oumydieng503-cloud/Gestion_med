<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <hr class="sidebar-divider my-0">

    <!-- Menu dynamique selon rôle -->
     <!-- rôle  ADMIN -->
    @if(Auth::user()->role === 'admin')
        <li class="nav-item">
            <a class="nav-link" href="/dashboard/admin">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard Admin</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="/admin/users">
                <i class="fas fa-fw fa-users"></i>
                <span>Gestion utilisateurs</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.services.index') }}">
                <i class="fas fa-fw fa-cogs"></i>
                <span>Gestion des services</span>
            </a>
        </li>



        <li class="nav-item">
            <a class="nav-link" href="/admin/reservations">
                <i class="fas fa-fw fa-calendar"></i>
                <span>Gestion réservations</span>
            </a>
        </li>
         <!--  rôle  MEDECIN -->
    @elseif(Auth::user()->role === 'medecin')
        <li class="nav-item">
            <a class="nav-link" href="/dashboard/medecin">
                <i class="fas fa-fw fa-user-md"></i>
                <span>Dashboard Médecin</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="/medecin/patients">
                <i class="fas fa-fw fa-procedures"></i>
                <span>Mes patients</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="/medecin/services">
                <i class="fas fa-fw fa-cogs"></i>
                <span>Mes services</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('medecin.reservations.index') }}">
                <i class="fas fa-fw fa-calendar"></i>
                <span>Réservations</span>
            </a>
        </li>
 <!--  rôle  PATIENT -->
    @elseif(Auth::user()->role === 'patient')
        <li class="nav-item">
            <a class="nav-link" href="/dashboard/dashboardPatient">
                <i class="fas fa-fw fa-user"></i>
                <span>Mon espace</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('patient.services.index') }}">
                <i class="fas fa-fw fa-stethoscope"></i>
                <span>Services</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('reservations.myReservations') }}">
                <i class="fas fa-fw fa-calendar"></i>
                <span>Mes réservations</span>
            </a>
        </li>
    @endif



</ul>