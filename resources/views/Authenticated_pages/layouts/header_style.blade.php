{{-- Notification box --}}
<style>
    .notification-dropdown {
        width: 300px;
        max-height: 500px;
        overflow-y: auto;
        position: absolute;
        top: 100%;
        /* Position it right below the button */
        left: 0;
        /* Align it with the left edge of the button */
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        display: none;
        z-index: 1000;
        /* Ensure it appears above other content */
    }

    .notification-container {
        position: relative;
        display: inline-block;
    }

    .notification-item {
        border-radius: 5px;
        padding: 5px;
        border-bottom: 1px solid #f0f0f0;
        left: 0;
    }

    .notification-item div p {
        text-align: left;
    }

    .notification-item:hover {
        background-color: gainsboro
    }

    .notification-icon-header {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 5px;
    }

    .notification-icon {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 5px;
    }

    .notification-title {
        font-weight: bold;
        margin-bottom: 0;
    }

    .notification-description {
        color: #777;
        font-size: 0.9em;
        margin-bottom: 0;
    }

    .notification-time {
        font-size: 0.8em;
        color: #999;
    }
</style>

{{-- header search box --}}
<style>
    .search-container {
        position: relative;
        max-width: 600px;
        margin: 0 auto;
    }

    .search-input {

        width: 100%;
        padding: 10px 40px 10px 10px;
        font-size: 16px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .search-icon {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: #888;
    }

    .search-results {
        position: absolute;
        top: 110%;
        left: 0;
        width: 100%;
        z-index: 1000;
        background-color: white;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        overflow-y: auto;
        /* Çok uzun sonuçlarda kaydırma çubuğu olsun */
        border-radius: 4px;
        border: 2px solid #ddd;

    }

    .category {
        padding: 10px;
        border-bottom: 1px solid #eee;
    }

    .category:last-child {
        border-bottom: none;
    }

    .category-title {
        font-size: 14px;
        color: #888;
        margin-bottom: 5px;
    }

    .result-item {
        display: flex;
        align-items: center;
        padding: 5px 0;
    }

    .result-icon {
        margin-right: 10px;
        font-size: 20px;
    }

    .result-item:hover {
        background-color: #e1e1e1;
        border-radius: 5px;
    }
</style>

<style>
    .custom-hr {
        margin: 5px 0;
        /* Üst ve alt boşluğu küçültür */
        padding: 0;
        border: none;
        /* Eğer sadece ince bir çizgi istiyorsanız border özelliğini kaldırın */
        border-top: 1px solid #ccc;
        /* İnce bir çizgi ekler */
    }
</style>

{{-- spinner --}}

<style>
    /* From Uiverse.io by Chriskoziol */
    .spinnerContainer {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        /* Ortalamak için */
        display: flex;
        flex-direction: column;
        align-items: center;
        z-index: 50;
    }

    .spinner {
        width: 56px;
        height: 56px;
        display: grid;
        border: 4px solid #0000;
        border-radius: 50%;
        border-right-color: #299fff;
        animation: tri-spinner 1s infinite linear;
    }

    .spinner::before,
    .spinner::after {
        content: "";
        grid-area: 1/1;
        margin: 2px;
        border: inherit;
        border-radius: 50%;
        animation: tri-spinner 2s infinite;
    }

    .spinner::after {
        margin: 8px;
        animation-duration: 3s;
    }

    @keyframes tri-spinner {
        100% {
            transform: rotate(1turn);
        }
    }

    .loader {
        color: #4a4a4a;
        font-family: "Poppins", sans-serif;
        font-weight: 500;
        font-size: 25px;
        -webkit-box-sizing: content-box;
        box-sizing: content-box;
        height: 40px;
        padding: 10px 10px;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        border-radius: 8px;
    }

    .words {
        overflow: hidden;
    }

    .word {
        display: block;
        height: 100%;
        padding-left: 6px;
        color: #299fff;
        animation: cycle-words 5s infinite;
    }

    @keyframes cycle-words {
        10% {
            -webkit-transform: translateY(-105%);
            transform: translateY(-105%);
        }

        25% {
            -webkit-transform: translateY(-100%);
            transform: translateY(-100%);
        }

        35% {
            -webkit-transform: translateY(-205%);
            transform: translateY(-205%);
        }

        50% {
            -webkit-transform: translateY(-200%);
            transform: translateY(-200%);
        }

        60% {
            -webkit-transform: translateY(-305%);
            transform: translateY(-305%);
        }

        75% {
            -webkit-transform: translateY(-300%);
            transform: translateY(-300%);
        }

        85% {
            -webkit-transform: translateY(-405%);
            transform: translateY(-405%);
        }

        100% {
            -webkit-transform: translateY(-400%);
            transform: translateY(-400%);
        }
    }
</style>


{{-- header --}}
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
    }

    .banner {
        margin-top: -150px;
    }

    .header {
        z-index: 500;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem;
        background-color: white;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        position: relative;
    }

    .logo-img {
        height: auto;
        width: 100px;
    }

    .logo {
        display: flex;
        justify-content: center;
    }

    .search-container {
        display: flex;
        margin-right: 1rem;
    }

    .search-input {
        padding: 10px 40px 10px 15px;
        border: 2px solid #ccc;
        border-radius: 25px;
        outline: none;
        font-size: 16px;
        transition: all 0.3s ease;
        width: 300px;
        max-width: 100%;
    }

    .search-input:focus {
        border-color: #4CAF50;
        box-shadow: 0 0 8px rgba(76, 175, 80, 0.5);
    }

    .search-icon {
        font-size: 1rem;
    }

    .nav {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .nav-link {
        text-decoration: none;
        color: #333;
        font-size: 1.1rem;
    }

    .dropdown {
        position: relative;
    }

    .dropbtn {
        background: none;
        border: none;
        font-size: 1.1rem;
        color: #333;
        cursor: pointer;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        width: 100%;
        text-align: center;
    }

    .arrow {
        font-size: 0.8rem;
        transition: transform 0.3s ease;
    }

    .dropdown.active .arrow {
        transform: rotate(180deg);
    }

    .dropdown-content {
        max-height: 400px; /* Maksimum yükseklik */
        overflow-y: auto; /* Dikey kaydırma çubuğunu etkinleştir */
        display: none;
        background-color: white;
        min-width: 200px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        padding: 0.5rem 0;
    }

    .dropdown.active .dropdown-content {
        display: block;
    }

    .dropdown-content a {
        color: #333;
        padding: 0.5rem 1rem;
        text-decoration: none;
        display: block;
        font-size: 1rem;
    }

    .dropdown-content a:hover {
        background-color: #f5f5f5;
    }

    .menu-toggle {
        display: none;
        background: none;
        border: none;
        font-size: 1.5rem;
        cursor: pointer;
    }

    #notificationDropdown {
        position: absolute;
        left: -50px;
        width: 300px;
        height: 600px;
        overflow-y: auto;

    }

    @media screen and (min-width: 1000px) {




        .nav {
            flex-direction: row;
            align-items: center;
            justify-content: center;
            gap: 2rem;
        }

        .dropdown,
        .nav-link {
            flex: 1;
            text-align: center;
        }

        .dropdown-content {
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1000;
            margin-top: 0.5rem;
        }
    }

    @media screen and (max-width: 999px) {



        .input-livewire {
            width: 130%;
        }

        .header {
            flex-wrap: wrap;
            justify-content: center;
        }

        .logo {
            width: 100%;
            text-align: center;
            margin-bottom: 1rem;
        }

        .nav {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            background-color: white;
            z-index: 1000;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 1rem;
            max-height: 80vh;
            overflow-y: auto;
        }

        .nav.active {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .nav-link,
        .dropdown {
            width: 100%;
            text-align: center;
        }

        .search-container {
            order: 2;
            margin-top: 1rem;
            margin: 0;
            width: 100%;

            display: flex;
            justify-content: center;
        }

        .search-input {
            flex-grow: 0;
            width: 90%;
            margin: 0;
            justify-content: center;


        }

        .menu-toggle {
            display: block;
            order: 1;
            position: absolute;
            top: 1rem;
            right: 1rem;
        }

        .dropdown-content {
            position: static;
            box-shadow: none;
            padding-left: 0;
            background-color: #f5f5f5;
            width: 100%;
        }

        .dropdown-content a {
            text-align: center;
        }
    }

    #profile-dropdown {
        @media (max-width: 768px) {
            #profile-dropdown {
                left: 0px;
                /* Mobil ekranlarda sola kaydırmayı kaldır */
            }
        }
    }

    #all-notis {
        background-color: #eee;
    }

    #all-notis:hover {
        background-color: #ccc;
    }

    .notification-title {
        left: 0;
    }
</style>


{{-- footer sabitleme body css , main'de flex:1 yap--}}
<style>
    body {
            margin: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Tam sayfa yüksekliği */
        }
</style>
