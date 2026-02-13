<!DOCTYPE html>
<html lang="ar" dir="rtl" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>شركة الاستقامة لاجزاء البودي</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet">
    <link rel="icon" href="<?php echo e(asset('asset/images/logo-sm.png')); ?>" type="image/png">
    <style>
        body {
            font-family: 'Tajawal', sans-serif;
        }

        .hero-gradient {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1486262715619-67b85e0b08d3?q=80&w=1600&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
        }

        .table-row-hover:hover {
            background-color: rgba(34, 197, 94, 0.05);
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-900">

    <!-- Header / Navbar -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
            <div class="text-2xl font-bold text-green-600 flex items-center gap-2">
                <img src="<?php echo e(asset('asset/images/logo-sm.png')); ?>" alt="Logo" class="h-10 w-10">
                الاستقامة لاجزاء البودي
            </div>
            <div class="hidden md:flex space-x-reverse space-x-8 font-medium">
                <a href="#home" class="hover:text-green-600 transition">الرئيسية</a>
                <a href="#services" class="hover:text-green-600 transition">خدماتنا</a>
                <!-- <a href="#parts" class="hover:text-green-600 transition">قطع الغيار</a> -->
                <a href="#contact" class="hover:text-green-600 transition">اتصل بنا</a>
            </div>
            <a href="https://wa.me/249900000000"
                class="bg-green-600 text-white px-6 py-2 rounded-full font-bold hover:bg-green-700 transition shadow-lg">
                اطلب الآن
            </a>
        </nav>
    </header>

    <!-- Hero Section -->
    <section id="home" class="hero-gradient h-[600px] flex items-center text-white">
        <div class="container mx-auto px-6 text-center md:text-right">
            <h1 class="text-4xl md:text-6xl font-extrabold mb-4 leading-tight">
                وجهتك الموثوقة لقطع غيار <br> <span class="text-green-500">اجزاء بودي السيارات الأصلية</span>
            </h1>
            <p class="text-xl md:text-2xl mb-8 text-gray-200 max-w-2xl">
                نوفر لكم تشكيلة واسعة من قطع غيار الجديدة والمستعملة (التشليح) لجميع أنواع السيارات بأفضل الأسعار
                وبضمان حقيقي.
            </p>
            <div class="flex flex-wrap justify-center md:justify-start gap-4">
                <a href="#parts"
                    class="bg-green-600 px-8 py-3 rounded-lg text-lg font-bold hover:bg-green-700 transition">استكشف
                    القطع</a>
                <a href="#services"
                    class="bg-white text-gray-900 px-8 py-3 rounded-lg text-lg font-bold hover:bg-gray-100 transition">لماذا
                    نحن؟</a>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <div class="container mx-auto px-6 -mt-16 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-8 rounded-xl shadow-xl text-center border-b-4 border-green-600">
                <div class="text-3xl font-bold text-gray-800 mb-2">+10,000</div>
                <div class="text-gray-600">قطعة غيار متوفرة</div>
            </div>
            <div class="bg-white p-8 rounded-xl shadow-xl text-center border-b-4 border-green-600">
                <div class="text-3xl font-bold text-gray-800 mb-2">100%</div>
                <div class="text-gray-600">ضمان الجودة والتشغيل</div>
            </div>
            <div class="bg-white p-8 rounded-xl shadow-xl text-center border-b-4 border-green-600">
                <div class="text-3xl font-bold text-gray-800 mb-2">+5,000</div>
                <div class="text-gray-600">عميل سعيد سنوياً</div>
            </div>
        </div>
    </div>

    <!-- Services Section -->
    <section id="services" class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">ماذا نقدم في الاستقامة؟</h2>
                <div class="w-20 h-1.5 bg-green-600 mx-auto rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 text-center">
                <!-- Service 1 -->
                <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-md transition">
                    <div
                        class="w-16 h-16 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">قطع أصلية جديدة</h3>
                    <p class="text-gray-600 text-sm">قطع غيار وكالة مضمونة لجميع الماركات العالمية والموديلات الحديثة.
                    </p>
                </div>
                <!-- Service 2 -->
                <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-md transition">
                    <div
                        class="w-16 h-16 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">قطع مستعملة (تشليح)</h3>
                    <p class="text-gray-600 text-sm">قطع نظيفة ومفحوصة بعناية من سيارات تشليح بأداء ممتاز وسعر اقتصادي.
                    </p>
                </div>
                <!-- Service 3 -->
                <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-md transition">
                    <div
                        class="w-16 h-16 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">شحن سريع</h3>
                    <p class="text-gray-600 text-sm">تغطية شاملة وتوصيل سريع لجميع مناطق السودان بأسعار مناسبة.</p>
                </div>
                <!-- Service 4 -->
                <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-md transition">
                    <div
                        class="w-16 h-16 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">دعم فني متخصص</h3>
                    <p class="text-gray-600 text-sm">طاقم من الخبراء لمساعدتك في اختيار القطعة الصحيحة المناسبة لسيارتك.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Optimized Contact & Branches Section -->
    <section id="contact" class="py-24 bg-slate-950 text-white relative overflow-hidden">
        <div class="absolute top-0 right-0 w-96 h-96 bg-green-600/10 rounded-full blur-3xl -mr-48 -mt-48"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-green-900/10 rounded-full blur-3xl -ml-32 -mb-32"></div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">

                <!-- Info Side -->
                <div class="lg:col-span-4 space-y-10">
                    <div>
                        <span
                            class="inline-block px-4 py-1 rounded-full bg-green-500/10 border border-green-500/20 text-green-500 text-sm font-bold mb-4">نحن
                            في خدمتك</span>
                        <h2 class="text-4xl font-black mb-6">تواصل معنا الآن</h2>
                        <p class="text-gray-400 text-lg leading-relaxed">
                            متواجدون لخدمتكم وتوفير كافة طلباتكم من قطع الغيار الأصلية والتشليح مع ضمان الجودة.
                        </p>
                    </div>

                    <div class="space-y-6">
                        <div
                            class="flex items-center gap-6 p-5 rounded-2xl bg-white/5 border border-white/10 group hover:border-green-500/50 transition-all">
                            <div
                                class="w-12 h-12 bg-green-600/20 border border-green-600/30 rounded-xl flex items-center justify-center text-green-500 group-hover:scale-110 transition-transform">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-300">الرقم الموحد</h4>
                                <p class="text-white font-mono text-lg" dir="ltr">+249 900 000 000</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-6 p-5 rounded-2xl bg-white/5 border border-white/10">
                            <div
                                class="w-12 h-12 bg-green-600/20 border border-green-600/30 rounded-xl flex items-center justify-center text-green-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-300">ساعات العمل</h4>
                                <p class="text-white">السبت - الخميس (8 ص - 9 م)</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Branches Side -->
                <div class="lg:col-span-8 bg-white text-gray-900 rounded-[2.5rem] shadow-2xl overflow-hidden relative">
                    <div class="absolute top-0 right-0 left-0 h-2 bg-green-600"></div>

                    <div class="p-8 md:p-12">
                        <h3
                            class="text-2xl font-black mb-8 border-b border-gray-100 pb-4 text-slate-800 tracking-tight">
                            مواقع الفروع</h3>

                        <!-- Responsive Container -->
                        <div class="overflow-hidden rounded-2xl border border-gray-100 shadow-sm">
                            <!-- Desktop View -->
                            <div class="hidden md:block">
                                <table class="w-full text-right">
                                    <thead class="bg-slate-50 text-slate-500 text-xs uppercase tracking-widest">
                                        <tr>
                                            <th class="py-4 px-6 font-bold">الفرع</th>
                                            <th class="py-4 px-6 font-bold">العنوان التفصيلي</th>
                                            <th class="py-4 px-6 font-bold text-center">تواصل سريع</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-50">
                                        <tr class="table-row-hover transition-colors">
                                            <td class="py-6 px-6">
                                                <div class="font-black text-slate-800">أمدرمان</div>
                                                <span
                                                    class="text-[10px] bg-green-50 text-green-600 px-2 py-0.5 rounded font-bold">المركز
                                                    الرئيسي</span>
                                            </td>
                                            <td class="py-6 px-6 text-gray-600 text-sm leading-relaxed font-medium">
                                                المنطقة الصناعية - أمام البوابة الجنوبية <br> لحديقة أمدرمان الكبرى
                                            </td>
                                            <td class="py-6 px-6">
                                                <div class="flex items-center justify-center gap-3">
                                                    <a href="tel:+249900000001"
                                                        class="p-3 bg-slate-100 text-slate-600 rounded-xl hover:bg-green-600 hover:text-white transition-all shadow-sm">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                                        </svg>
                                                    </a>
                                                    <a href="https://wa.me/249900000001"
                                                        class="flex items-center gap-2 p-3 px-4 bg-green-500 text-white rounded-xl hover:bg-green-600 transition-all shadow-md shadow-green-100">
                                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                            <path
                                                                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.012 0C5.411 0 .028 5.383.025 11.983c0 2.112.552 4.17 1.6 5.996L0 24l6.16-1.615a11.846 11.846 0 005.85 1.542h.005c6.599 0 11.984-5.383 11.988-11.985a11.816 11.816 0 00-3.417-8.471" />
                                                        </svg>
                                                        <span class="font-bold text-sm">واتساب</span>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Mobile View (Card Style) -->
                            <div class="md:hidden p-4 space-y-4 bg-slate-50">
                                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                                    <h4 class="font-black text-xl text-slate-900 mb-2">أمدرمان</h4>
                                    <p class="text-sm text-gray-500 mb-6 leading-relaxed">المنطقة الصناعية - أمام
                                        البوابة الجنوبية لحديقة أمدرمان الكبرى</p>
                                    <div class="grid grid-cols-2 gap-3">
                                        <a href="tel:+249900000001"
                                            class="flex items-center justify-center p-3 bg-slate-100 text-slate-600 rounded-xl font-bold text-sm italic transition-colors hover:bg-green-600 hover:text-white">اتصال</a>
                                        <a href="https://wa.me/249900000001"
                                            class="flex items-center justify-center p-3 bg-green-500 text-white rounded-xl font-bold text-sm italic">واتساب</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <p class="mt-8 text-center text-gray-400 text-xs italic">
                            * يمكنك النقر على الأيقونات للمحادثة المباشرة مع مبيعات الفرع.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <div class="col-span-1 md:col-span-1">
                    <div class="text-2xl font-bold text-green-500 mb-6 flex items-center gap-2">
                        الاستقامة
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        نحن شركة متخصصة في توفير كافة حلول قطع غيار السيارات بجودة عالية وبأسعار منافسة في السوق
                        السوداني.
                    </p>
                </div>
                <div>
                    <h4 class="font-bold text-lg mb-6">روابط سريعة</h4>
                    <ul class="space-y-3 text-gray-400">
                        <li><a href="#home" class="hover:text-green-500 transition">الرئيسية</a></li>
                        <li><a href="#services" class="hover:text-green-500 transition">من نحن</a></li>
                        <li><a href="#parts" class="hover:text-green-500 transition">قطع الغيار</a></li>
                        <li><a href="#contact" class="hover:text-green-500 transition">اتصل بنا</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-lg mb-6">ساعات العمل</h4>
                    <ul class="space-y-3 text-gray-400 text-sm">
                        <li class="flex justify-between"><span>السبت - الخميس:</span> <span>8 ص - 9 م</span></li>
                        <li class="flex justify-between"><span>الجمعة:</span> <span class="text-green-500">مغلق</span>
                        </li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-lg mb-6">اشترك في النشرة</h4>
                    <p class="text-gray-400 text-sm mb-4">احصل على آخر العروض والخصومات فور وصولها.</p>
                    <div class="flex gap-2">
                        <input type="email" placeholder="بريدك الإلكتروني"
                            class="bg-gray-800 border-none px-4 py-2 rounded-lg text-sm focus:ring-1 focus:ring-green-600 w-full">
                        <button class="bg-green-600 px-4 py-2 rounded-lg hover:bg-green-700 transition">سجل</button>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8 text-center text-gray-500 text-sm">
               <a href="https://deyaa.alsultansudan.com"> <p>جميع الحقوق محفوظة &copy;  لشركة ضياء البشري محمد <?php echo date('Y'); ?> </p></a>
            </div>
        </div>
    </footer>

</body>

</html><?php /**PATH /Users/mac/Herd/MohamedHashim/resources/views/welcome.blade.php ENDPATH**/ ?>