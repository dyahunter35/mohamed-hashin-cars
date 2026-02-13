<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>شركة الاستقامة لقطع غيار السيارات - السودان</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('asset/images/logo-sm.png') }}">
    <style>
        body {
            font-family: 'Tajawal', sans-serif;
            scroll-behavior: smooth;

        }

        html {
            scroll-behavior: smooth;
        }


        .hero-gradient {
            background: linear-gradient(rgba(17, 24, 39, 0.85), rgba(17, 24, 39, 0.85)), url('https://images.unsplash.com/photo-1486262715619-67b85e0b08d3?q=80&w=1600&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(12px);
        }

        .card-hover:hover {
            transform: translateY(-10px);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .branch-badge {
            background: linear-gradient(90deg, #10b981, #059669);
        }

        .custom-green-shadow {
            box-shadow: 0 10px 15px -3px rgba(16, 185, 129, 0.2);
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-900">

    <!-- Header / Navbar -->
    <header class="glass-effect shadow-sm sticky top-0 z-50 border-b border-green-50">
        <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
            <div class="text-2xl font-bold text-emerald-600 flex items-center gap-2">
                <img src="{{ asset('asset/images/logo-sm.png') }}" alt="Logo" class="h-10 w-10">
                <span class="tracking-tighter">الاستقامة</span>
            </div>
            <div class="hidden lg:flex space-x-reverse space-x-8 font-semibold text-gray-700">
                <a href="#home" class="hover:text-emerald-600 transition">الرئيسية</a>
                <a href="#branches" class="hover:text-emerald-600 transition">فروعنا</a>
                <a href="#parts" class="hover:text-emerald-600 transition">قطع الغيار</a>
                <a href="#contact" class="hover:text-emerald-600 transition">اتصل بنا</a>
            </div>
            <div class="flex items-center gap-4">
                <div
                    class="hidden sm:flex items-center gap-2 bg-emerald-50 px-3 py-1 rounded-full border border-emerald-100">
                    <span class="text-sm font-bold text-emerald-700">السودان</span>
                    <span class="text-lg">🇸🇩</span>
                </div>
                <a href="https://wa.me/249xxxxxxxxx"
                    class="bg-emerald-600 text-white px-5 py-2.5 rounded-lg font-bold hover:bg-emerald-700 transition shadow-lg custom-green-shadow text-sm">
                    اطلب الآن
                </a>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section id="home" class="hero-gradient min-h-[650px] flex items-center text-white relative overflow-hidden">
        <div class="container mx-auto px-6 relative z-10">
            <div class="max-w-3xl">
                <h1 class="text-5xl md:text-7xl font-extrabold mb-6 leading-tight">
                    وجهتك الموثوقة لقطع غيار <br> <span
                        class="text-emerald-500 underline decoration-white/20 underline-offset-8">السيارات
                        بالسودان</span>
                </h1>
                <p class="text-xl md:text-2xl mb-10 text-gray-200 leading-relaxed font-light">
                    نحن في شركة الاستقامة نوفر لكم أفضل تشكيلة من قطع الغيار الأصلية والجديدة والمستعملة (التشليح) لجميع
                    أنواع السيارات عبر شبكة فروعنا الواسعة.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="#branches"
                        class="bg-emerald-600 px-10 py-4 rounded-xl text-lg font-bold hover:bg-emerald-700 transition-all transform hover:scale-105 shadow-xl shadow-emerald-900/40">
                        فروعنا في السودان
                    </a>
                    <a href="#parts"
                        class="bg-white/10 backdrop-blur-md border border-white/20 px-10 py-4 rounded-xl text-lg font-bold hover:bg-white/20 transition-all">
                        تصفح الأقسام
                    </a>
                </div>
            </div>
        </div>
        <!-- Decorative element -->
        <div class="absolute bottom-0 left-0 w-full h-24 bg-gradient-to-t from-gray-50 to-transparent"></div>
    </section>

    <!-- Features Stats -->
    <div class="container mx-auto px-6 -mt-16 relative z-20">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div
                class="bg-white p-8 rounded-2xl shadow-xl flex items-center gap-6 border-b-4 border-emerald-600 card-hover">
                <div
                    class="w-16 h-16 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600 flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <div class="text-2xl font-black text-gray-800 uppercase tracking-wide">100%</div>
                    <div class="text-gray-500 font-medium text-sm">ضمان الجودة الفائقة</div>
                </div>
            </div>
            <div
                class="bg-white p-8 rounded-2xl shadow-xl flex items-center gap-6 border-b-4 border-emerald-600 card-hover">
                <div
                    class="w-16 h-16 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600 flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <div>
                    <div class="text-2xl font-black text-gray-800">+15,000</div>
                    <div class="text-gray-500 font-medium text-sm">قطعة غيار متوفرة</div>
                </div>
            </div>
            <div
                class="bg-white p-8 rounded-2xl shadow-xl flex items-center gap-6 border-b-4 border-emerald-600 card-hover">
                <div
                    class="w-16 h-16 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600 flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                </div>
                <div>
                    <div class="text-2xl font-black text-gray-800">3 فروع</div>
                    <div class="text-gray-500 font-medium text-sm">نغطي أهم المدن</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Branches Section -->
    <section id="branches" class="py-24 bg-gray-50">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl md:text-5xl font-extrabold text-gray-900 mb-4">فروعنا في قلب السودان</h2>
            <div class="w-24 h-2 bg-emerald-600 mx-auto rounded-full mb-8"></div>
            <p class="text-gray-600 max-w-2xl mx-auto text-lg mb-16">
                نحن في الاستقامة نفتخر بتواجدنا في أهم المراكز الحيوية لنكون الأقرب لسيارتك دائماً.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <!-- Branch Card: Omdurman -->
                <div
                    class="group bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100">
                    <div class="h-56 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1541899481282-d53bffe3c35d?q=80&w=800&auto=format&fit=crop"
                            class="w-full h-full object-cover group-hover:scale-110 transition duration-500"
                            alt="أمدرمان">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                        <div
                            class="absolute bottom-4 right-4 branch-badge text-white px-4 py-1.5 rounded-full font-bold text-sm shadow-lg">
                            أمدرمان</div>
                    </div>
                    <div class="p-8 text-right">
                        <h3 class="text-2xl font-bold mb-4 flex items-center gap-2">
                            <span class="w-2 h-8 bg-emerald-600 rounded-full"></span>
                            فرع المنطقة الصناعية
                        </h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">المركز الرئيسي لقطع الغيار الجديدة والماركات
                            العالمية الحديثة في قلب أمدرمان.</p>
                        <div
                            class="flex items-center gap-2 text-emerald-600 font-bold group-hover:gap-4 transition-all">
                            <span>زيارة الموقع</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 rotate-180" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Branch Card: Medani -->
                <div
                    class="group bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100">
                    <div class="h-56 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1517524206127-48bbd363f3d7?q=80&w=800&auto=format&fit=crop"
                            class="w-full h-full object-cover group-hover:scale-110 transition duration-500" alt="مدني">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                        <div
                            class="absolute bottom-4 right-4 branch-badge text-white px-4 py-1.5 rounded-full font-bold text-sm shadow-lg">
                            مدني</div>
                    </div>
                    <div class="p-8 text-right">
                        <h3 class="text-2xl font-bold mb-4 flex items-center gap-2">
                            <span class="w-2 h-8 bg-emerald-600 rounded-full"></span>
                            فرع مدني
                        </h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">نوفر جميع احتياجات الصيانة الدورية في الجزيرة
                            بأعلى مواصفات الجودة.</p>
                        <div
                            class="flex items-center gap-2 text-emerald-600 font-bold group-hover:gap-4 transition-all">
                            <span>زيارة الموقع</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 rotate-180" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Branch Card: Al-Masoudiya -->
                <div
                    class="group bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100">
                    <div class="h-56 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1562426509-5044a121aa49?q=80&w=800&auto=format&fit=crop"
                            class="w-full h-full object-cover group-hover:scale-110 transition duration-500"
                            alt="المسعودية">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                        <div
                            class="absolute bottom-4 right-4 branch-badge text-white px-4 py-1.5 rounded-full font-bold text-sm shadow-lg">
                            المسعودية</div>
                    </div>
                    <div class="p-8 text-right">
                        <h3 class="text-2xl font-bold mb-4 flex items-center gap-2">
                            <span class="w-2 h-8 bg-emerald-600 rounded-full"></span>
                            فرع الطريق السريع
                        </h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">مركز متخصص في قطع غيار التشليح المستعملة النظيفة
                            لسيارات الدفع الرباعي والشاحنات.</p>
                        <div
                            class="flex items-center gap-2 text-emerald-600 font-bold group-hover:gap-4 transition-all">
                            <span>زيارة الموقع</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 rotate-180" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section id="parts" class="py-24 bg-white">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-center mb-16 gap-6">
                <div class="text-center md:text-right">
                    <h2 class="text-4xl font-extrabold text-gray-900 mb-4">ماذا نوفر لك؟</h2>
                    <p class="text-gray-600 font-medium">أقسام شاملة لجميع موديلات السيارات بأفضل الأسعار</p>
                </div>
                <div class="flex gap-4">
                    <div
                        class="bg-emerald-50 text-emerald-700 px-6 py-2 rounded-full font-bold text-sm border border-emerald-100">
                        قطع جديدة</div>
                    <div class="bg-gray-100 text-gray-600 px-6 py-2 rounded-full font-bold text-sm">تشليح أصلي</div>
                </div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6 text-center">
                <!-- Cat 1 -->
                <div class="group cursor-pointer">
                    <div
                        class="bg-gray-50 rounded-3xl p-8 border-2 border-transparent group-hover:border-emerald-600 group-hover:bg-emerald-50 transition-all duration-300">
                        <img src="https://cdn-icons-png.flaticon.com/512/2885/2885421.png"
                            class="w-20 h-20 mx-auto mb-6 grayscale group-hover:grayscale-0 transition" alt="المحركات">
                        <span class="font-extrabold text-gray-800 group-hover:text-emerald-700">المحركات</span>
                    </div>
                </div>
                <!-- Cat 2 -->
                <div class="group cursor-pointer">
                    <div
                        class="bg-gray-50 rounded-3xl p-8 border-2 border-transparent group-hover:border-emerald-600 group-hover:bg-emerald-50 transition-all duration-300">
                        <img src="https://cdn-icons-png.flaticon.com/512/1000/1000854.png"
                            class="w-20 h-20 mx-auto mb-6 grayscale group-hover:grayscale-0 transition" alt="الفرامل">
                        <span class="font-extrabold text-gray-800 group-hover:text-emerald-700 text-sm">أنظمة
                            الفرامل</span>
                    </div>
                </div>
                <!-- Cat 3 -->
                <div class="group cursor-pointer">
                    <div
                        class="bg-gray-50 rounded-3xl p-8 border-2 border-transparent group-hover:border-emerald-600 group-hover:bg-emerald-50 transition-all duration-300">
                        <img src="https://cdn-icons-png.flaticon.com/512/3039/3039462.png"
                            class="w-20 h-20 mx-auto mb-6 grayscale group-hover:grayscale-0 transition" alt="الجيربكس">
                        <span class="font-extrabold text-gray-800 group-hover:text-emerald-700">الجيربكس</span>
                    </div>
                </div>
                <!-- Cat 4 -->
                <div class="group cursor-pointer">
                    <div
                        class="bg-gray-50 rounded-3xl p-8 border-2 border-transparent group-hover:border-emerald-600 group-hover:bg-emerald-50 transition-all duration-300">
                        <img src="https://cdn-icons-png.flaticon.com/512/3202/3202926.png"
                            class="w-20 h-20 mx-auto mb-6 grayscale group-hover:grayscale-0 transition" alt="الهيكل">
                        <span class="font-extrabold text-gray-800 group-hover:text-emerald-700">قطع الهيكل</span>
                    </div>
                </div>
                <!-- Cat 5 -->
                <div class="group cursor-pointer">
                    <div
                        class="bg-gray-50 rounded-3xl p-8 border-2 border-transparent group-hover:border-emerald-600 group-hover:bg-emerald-50 transition-all duration-300">
                        <img src="https://cdn-icons-png.flaticon.com/512/2983/2983804.png"
                            class="w-20 h-20 mx-auto mb-6 grayscale group-hover:grayscale-0 transition" alt="الكهرباء">
                        <span class="font-extrabold text-gray-800 group-hover:text-emerald-700 text-sm">الكهرباء</span>
                    </div>
                </div>
                <!-- Cat 6 -->
                <div class="group cursor-pointer">
                    <div
                        class="bg-gray-50 rounded-3xl p-8 border-2 border-transparent group-hover:border-emerald-600 group-hover:bg-emerald-50 transition-all duration-300">
                        <img src="https://cdn-icons-png.flaticon.com/512/741/741407.png"
                            class="w-20 h-20 mx-auto mb-6 grayscale group-hover:grayscale-0 transition" alt="الإطارات">
                        <span class="font-extrabold text-gray-800 group-hover:text-emerald-700">الإطارات</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- WhatsApp CTA -->
    <div class="fixed bottom-8 left-8 z-[100] group">
        <a href="https://wa.me/249xxxxxxxxx"
            class="flex items-center gap-3 bg-green-500 text-white p-4 rounded-full shadow-2xl hover:bg-green-600 transition-all transform group-hover:scale-110">
            <span
                class="max-w-0 overflow-hidden group-hover:max-w-xs transition-all duration-500 font-bold whitespace-nowrap">اطلب
                عبر واتساب</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="currentColor" viewBox="0 0 24 24">
                <path
                    d="M12.012 2c-5.506 0-9.989 4.478-9.99 9.984a9.964 9.964 0 001.333 4.993L2 22l5.233-1.237a9.921 9.921 0 004.779 1.217h.004c5.505 0 9.988-4.478 9.989-9.984 0-2.669-1.037-5.176-2.922-7.062A9.925 9.925 0 0012.012 2z" />
            </svg>
        </a>
    </div>

    <!-- Contact Section -->
    <section id="contact" class="py-24 bg-slate-950 text-white relative overflow-hidden">
        <!-- Background Decorations -->
        <div
            class="absolute top-0 right-0 w-[500px] h-[500px] bg-emerald-600/10 rounded-full blur-[120px] -mr-64 -mt-64">
        </div>
        <div
            class="absolute bottom-0 left-0 w-[300px] h-[300px] bg-emerald-900/10 rounded-full blur-[80px] -ml-32 -mb-32">
        </div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">

                <!-- Left Side: Info -->
                <div class="lg:col-span-4 space-y-10">
                    <div>
                        <span
                            class="inline-block px-4 py-2 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-sm font-bold mb-4 uppercase tracking-wider">تواصل
                            معنا</span>
                        <h2 class="text-4xl md:text-5xl font-black mb-6 leading-tight">نحن دائماً في <span
                                class="text-emerald-500">خدمتك</span></h2>
                        <p class="text-gray-400 text-lg leading-relaxed italic">
                            "سواء كنت في أمدرمان، مدني، أو المسعودية، نحن نوفر لك حلولاً متكاملة لصيانة سيارتك بقطع
                            أصلية وأسعار تنافسية."
                        </p>
                    </div>

                    <div class="grid grid-cols-1 gap-6">
                        <!-- Unit Number -->
                        <div
                            class="group flex items-center gap-6 p-6 rounded-3xl bg-white/5 border border-white/10 hover:border-emerald-500/50 transition-all duration-300">
                            <div
                                class="w-14 h-14 bg-emerald-600/20 border border-emerald-600/30 rounded-2xl flex items-center justify-center text-emerald-500 group-hover:scale-110 transition-transform">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-400 text-sm">الرقم الموحد</h4>
                                <p class="text-xl text-white font-mono font-black tracking-tighter" dir="ltr">+249 900
                                    000 000</p>
                            </div>
                        </div>

                        <!-- Hours -->
                        <div class="group flex items-center gap-6 p-6 rounded-3xl bg-white/5 border border-white/10">
                            <div
                                class="w-14 h-14 bg-emerald-600/20 border border-emerald-600/30 rounded-2xl flex items-center justify-center text-emerald-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-400 text-sm">ساعات العمل</h4>
                                <p class="text-lg text-white font-bold">السبت - الخميس <span
                                        class="text-emerald-500">(8ص - 9م)</span></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side: Branches Table -->
                <div
                    class="lg:col-span-8 bg-white text-gray-900 rounded-[2.5rem] shadow-2xl relative overflow-hidden flex flex-col h-full">
                    <!-- Highlight Bar -->
                    <div class="absolute top-0 right-0 left-0 h-2 bg-emerald-600"></div>

                    <div class="p-8 md:p-12">
                        <div
                            class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8 border-b border-gray-100 pb-6">
                            <h3 class="text-3xl font-black text-slate-900">فروعنا وأرقام التواصل</h3>
                            <div
                                class="flex items-center gap-2 text-sm font-medium text-emerald-600 bg-emerald-50 px-4 py-2 rounded-full">
                                <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                                متاحون الآن لخدمتكم
                            </div>
                        </div>

                        <!-- Responsive Table Container -->
                        <div class="overflow-hidden rounded-2xl border border-gray-100 shadow-sm">
                            <!-- Desktop Table -->
                            <div class="hidden md:block overflow-x-auto">
                                <table class="w-full text-right">
                                    <thead>
                                        <tr
                                            class="bg-slate-50 text-slate-500 text-xs uppercase tracking-widest border-b border-gray-100">
                                            <th class="py-5 px-6 font-black">الفرع</th>
                                            <th class="py-5 px-6 font-black">العنوان</th>
                                            <th class="py-5 px-6 font-black text-center">أرقام التواصل</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-50">
                                        <!-- Branch 1 -->
                                        <tr class="hover:bg-emerald-50/30 transition-colors group">
                                            <td class="py-6 px-6">
                                                <div class="font-black text-slate-800">أمدرمان</div>
                                                <div
                                                    class="text-xs text-blue-600 font-bold bg-blue-50 px-2 py-0.5 rounded inline-block mt-1">
                                                    قطع غيار جديدة</div>
                                            </td>
                                            <td class="py-6 px-6 text-gray-500 text-sm leading-relaxed">المنطقة الصناعية
                                                <br> جوار مطاحن الغلال
                                            </td>
                                            <td class="py-6 px-6">
                                                <div class="flex items-center justify-center gap-2">
                                                    <a href="tel:+249900000001"
                                                        class="p-3 bg-slate-100 text-slate-600 rounded-xl hover:bg-emerald-600 hover:text-white transition-all shadow-sm"
                                                        title="اتصال">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                                        </svg>
                                                    </a>
                                                    <a href="https://wa.me/249900000001"
                                                        class="flex items-center gap-2 p-3 bg-green-500 text-white rounded-xl hover:bg-green-600 transition-all shadow-md shadow-green-200"
                                                        title="واتساب">
                                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                            <path
                                                                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.012 0C5.411 0 .028 5.383.025 11.983c0 2.112.552 4.17 1.6 5.996L0 24l6.16-1.615a11.846 11.846 0 005.85 1.542h.005c6.599 0 11.984-5.383 11.988-11.985a11.816 11.816 0 00-3.417-8.471" />
                                                        </svg>
                                                        <span class="font-bold text-sm">مراسلة</span>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Branch 2 -->
                                        <tr class="hover:bg-emerald-50/30 transition-colors group">
                                            <td class="py-6 px-6">
                                                <div class="font-black text-slate-800">مدني</div>
                                                <div
                                                    class="text-xs text-emerald-600 font-bold bg-emerald-50 px-2 py-0.5 rounded inline-block mt-1">
                                                    فرع شامل</div>
                                            </td>
                                            <td class="py-6 px-6 text-gray-500 text-sm leading-relaxed">السوق الكبير
                                                <br> شرق الجامع
                                            </td>
                                            <td class="py-6 px-6">
                                                <div class="flex items-center justify-center gap-2">
                                                    <a href="tel:+249900000002"
                                                        class="p-3 bg-slate-100 text-slate-600 rounded-xl hover:bg-emerald-600 hover:text-white transition-all shadow-sm">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                                        </svg>
                                                    </a>
                                                    <a href="https://wa.me/249900000002"
                                                        class="flex items-center gap-2 p-3 bg-green-500 text-white rounded-xl hover:bg-green-600 transition-all shadow-md">
                                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                            <path
                                                                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.012 0C5.411 0 .028 5.383.025 11.983c0 2.112.552 4.17 1.6 5.996L0 24l6.16-1.615a11.846 11.846 0 005.85 1.542h.005c6.599 0 11.984-5.383 11.988-11.985a11.816 11.816 0 00-3.417-8.471" />
                                                        </svg>
                                                        <span class="font-bold text-sm">مراسلة</span>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Branch 3 -->
                                        <tr class="hover:bg-emerald-50/30 transition-colors group">
                                            <td class="py-6 px-6">
                                                <div class="font-black text-slate-800">المسعودية</div>
                                                <div
                                                    class="text-xs text-amber-600 font-bold bg-amber-50 px-2 py-0.5 rounded inline-block mt-1">
                                                    تشليح أصلي</div>
                                            </td>
                                            <td class="py-6 px-6 text-gray-500 text-sm leading-relaxed">طريق مدني <br>
                                                بجوار المحطة</td>
                                            <td class="py-6 px-6">
                                                <div class="flex items-center justify-center gap-2">
                                                    <a href="tel:+249900000003"
                                                        class="p-3 bg-slate-100 text-slate-600 rounded-xl hover:bg-emerald-600 hover:text-white transition-all shadow-sm">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                                        </svg>
                                                    </a>
                                                    <a href="https://wa.me/249900000003"
                                                        class="flex items-center gap-2 p-3 bg-green-500 text-white rounded-xl hover:bg-green-600 transition-all shadow-md">
                                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                            <path
                                                                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.012 0C5.411 0 .028 5.383.025 11.983c0 2.112.552 4.17 1.6 5.996L0 24l6.16-1.615a11.846 11.846 0 005.85 1.542h.005c6.599 0 11.984-5.383 11.988-11.985a11.816 11.816 0 00-3.417-8.471" />
                                                        </svg>
                                                        <span class="font-bold text-sm">مراسلة</span>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Mobile Cards (Visible on Small Screens) -->
                            <div class="md:hidden space-y-4 p-4 bg-slate-50">
                                <!-- Branch Card 1 -->
                                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                                    <div class="flex justify-between items-start mb-4">
                                        <h4 class="font-black text-xl text-slate-800">أمدرمان</h4>
                                        <span
                                            class="text-[10px] bg-blue-50 text-blue-600 px-2 py-1 rounded font-bold uppercase">جديدة</span>
                                    </div>
                                    <p class="text-sm text-gray-500 mb-6">المنطقة الصناعية - جوار مطاحن الغلال</p>
                                    <div class="grid grid-cols-2 gap-3">
                                        <a href="tel:+249900000001"
                                            class="flex items-center justify-center gap-2 p-3 bg-slate-100 text-slate-600 rounded-xl font-bold text-sm italic">اتصال</a>
                                        <a href="https://wa.me/249900000001"
                                            class="flex items-center justify-center gap-2 p-3 bg-green-500 text-white rounded-xl font-bold text-sm italic">واتساب</a>
                                    </div>
                                </div>
                                <!-- Repeat for other branches -->
                                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                                    <div class="flex justify-between items-start mb-4">
                                        <h4 class="font-black text-xl text-slate-800">المسعودية</h4>
                                        <span
                                            class="text-[10px] bg-blue-50 text-blue-600 px-2 py-1 rounded font-bold uppercase">جديدة</span>
                                    </div>
                                    <p class="text-sm text-gray-500 mb-6">المنطقة الصناعية - جوار مطاحن الغلال</p>
                                    <div class="grid grid-cols-2 gap-3">
                                        <a href="tel:+249900000001"
                                            class="flex items-center justify-center gap-2 p-3 bg-slate-100 text-slate-600 rounded-xl font-bold text-sm italic">اتصال</a>
                                        <a href="https://wa.me/249900000001"
                                            class="flex items-center justify-center gap-2 p-3 bg-green-500 text-white rounded-xl font-bold text-sm italic">واتساب</a>
                                    </div>
                                </div>
                                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                                    <div class="flex justify-between items-start mb-4">
                                        <h4 class="font-black text-xl text-slate-800">مدني</h4>
                                        <span
                                            class="text-[10px] bg-blue-50 text-blue-600 px-2 py-1 rounded font-bold uppercase">جديدة</span>
                                    </div>
                                    <p class="text-sm text-gray-500 mb-6">المنطقة الصناعية - جوار مطاحن الغلال</p>
                                    <div class="grid grid-cols-2 gap-3">
                                        <a href="tel:+249900000001"
                                            class="flex items-center justify-center gap-2 p-3 bg-slate-100 text-slate-600 rounded-xl font-bold text-sm italic">اتصال</a>
                                        <a href="https://wa.me/249900000001"
                                            class="flex items-center justify-center gap-2 p-3 bg-green-500 text-white rounded-xl font-bold text-sm italic">واتساب</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <p class="mt-8 text-center text-gray-400 text-xs flex items-center justify-center gap-2 italic">
                            <svg class="w-4 h-4 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            انقر على الأيقونات للتواصل الفوري مع مبيعات الفرع المختص.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-black py-12 border-t border-gray-800">
        <div class="container mx-auto px-6 text-center">
            <div class="text-2xl font-black text-emerald-500 mb-6 italic tracking-widest">AL-ISTIQAMA</div>
            <p class="text-gray-500 text-sm mb-8 font-medium">شركة الاستقامة لقطع غيار السيارات - الريادة في خدمة
                السيارات بالسودان</p>
            <div class="flex justify-center gap-8 text-gray-400 mb-8 font-bold">
                <a href="#" class="hover:text-emerald-500 transition">فيسبوك</a>
                <a href="#" class="hover:text-emerald-500 transition">واتساب</a>
                <a href="#" class="hover:text-emerald-500 transition">تيك توك</a>
            </div>
            <div class="text-gray-600 text-xs border-t border-gray-900 pt-8">
                © 2024 جميع الحقوق محفوظة لشركة الاستقامة بالسودان | نفخر بخدمتكم
            </div>
        </div>
    </footer>

</body>

</html>