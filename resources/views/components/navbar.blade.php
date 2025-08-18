        <!-- Top Navigation -->
        @props(['user'])
        
        <nav class="top-nav">
            <div class="menu-toggle" id="menu-toggle">
                <i class="fas fa-bars"></i>
            </div>
            <div class="user-profile">
                <!-- Add a hidden checkbox and label -->
                <input type="checkbox" id="profile-toggle">
                <label for="profile-toggle" class="profile-trigger">
                    <div class="user-info">
                        <div class="name">{{ Auth::user()->name }}</div>
                        <div class="role">{{ Auth::user()->role }}</div>
                    </div>
                    <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="User Profile" style="width: 40px; height: 40px;">
                </label>
                
                <!-- Profile Dropdown -->
                <div class="profile-dropdown">
                    <a href="#"><i class="fas fa-user"></i> Profile</a>
                    <a href="#"><i class="fas fa-cog"></i> Settings</a>
                    <a href="#"><i class="fas fa-envelope"></i> Messages</a>
                    <div class="divider"></div>


                    <!-- Logout -->
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>

                </div>
            </div>
        </nav>

