<footer class="mt-auto" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container">
        <div class="row py-5 text-white">
            <div class="col-lg-4 mb-4 mb-lg-0">
                <h5 class="fw-bold mb-3">
                    <i class="bi bi-box-seam me-2"></i>Logistics Co.
                </h5>
                <p class="text-white-50 mb-3">
                    Бърза и надеждна доставка на пратки в цялата страна. Вашият надежден логистичен партньор.
                </p>
            </div>

            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0 text-center">
                <h6 class="fw-bold mb-3">Услуги</h6>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="{{ auth()->check() ? route('dashboard') : route('login') }}" class="text-white-50 text-decoration-none">
                            Изпращане
                        </a>
                    </li>

                    <li class="mb-2">
                        <a href="{{ auth()->check() ? route('dashboard') : route('login') }}" class="text-white-50 text-decoration-none">
                            Проследяване
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('prices') }}" class="text-white-50 text-decoration-none">
                            Ценоразпис
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-lg-4">
                <h6 class="fw-bold mb-3">Контакт</h6>
                <ul class="list-unstyled text-white-50">
                    <li class="mb-2">
                        <i class="bi bi-geo-alt me-2"></i>
                        гр. София, бул. Витоша 1
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-telephone me-2"></i>
                        +359 2 123 4567
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-envelope me-2"></i>
                        info@logistics.bg
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-clock me-2"></i>
                        Пон-Пет: 08:00 - 18:00
                    </li>
                </ul>
            </div>
        </div>

        <div class="border-top border-white border-opacity-25 py-4">
            <p class="mb-0 text-white-50">
                &copy; {{ date('Y') }} Logistics Company. Всички права запазени.
            </p>
        </div>
    </div>
</footer>

<style>
    footer a:hover {
        color: white !important;
        transform: translateX(3px);
    }
</style>