<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            brand: {
              orange:  '#D4682A',
              orangeL: '#E8783A',
              orangeD: '#B85520',
              navy:    '#1B2058',
              navyD:   '#0C0E1A',
              navyM:   '#131628',
              navyL:   '#1E2460',
            }
          },
          fontFamily: {
            display: ['Sora', 'sans-serif'],
            body:    ['Inter', 'sans-serif'],
          }
        }
      }
    }
  </script>
  <style>
    html { scroll-behavior: smooth; }
    body { font-family: 'Inter', sans-serif; background: #0C0E1A; color: #fff; }

    ::-webkit-scrollbar { width: 4px; }
    ::-webkit-scrollbar-track { background: #0C0E1A; }
    ::-webkit-scrollbar-thumb { background: #D4682A; border-radius: 99px; }

    .text-grad {
      background: linear-gradient(135deg, #D4682A 0%, #E8783A 50%, #F4A070 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .nav-glass {
      background: rgba(12,14,26,0.92);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
    }

    .hero-mask {
      background: linear-gradient(105deg,
        rgba(7,8,17,0.97) 0%,
        rgba(7,8,17,0.88) 40%,
        rgba(7,8,17,0.55) 70%,
        rgba(7,8,17,0.18) 100%
      );
    }

    .card-lift {
      transition: transform .28s ease, border-color .28s ease, box-shadow .28s ease;
    }
    .card-lift:hover {
      transform: translateY(-5px);
      border-color: #D4682A !important;
      box-shadow: 0 20px 60px rgba(212,104,42,.18);
    }

    /* Carrossel de veiculos (arrasta pro lado no mobile) */
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .veic-track { scroll-padding-left: 1.5rem; }
    .veic-track > div { scroll-snap-align: start; }
    @media (max-width: 767px) {
      .veic-track > div { flex: 0 0 86%; }
    }
    @media (min-width: 560px) and (max-width: 767px) {
      .veic-track > div { flex-basis: 60%; }
    }

    @keyframes pulse-org {
      0%,100% { box-shadow: 0 0 0 0 rgba(212,104,42,.45); }
      50%      { box-shadow: 0 0 0 14px rgba(212,104,42,0); }
    }
    .btn-pulse { animation: pulse-org 2.2s infinite; }

    @keyframes pulse-grn {
      0%,100% { box-shadow: 0 0 0 0 rgba(37,211,102,.5); }
      50%      { box-shadow: 0 0 0 14px rgba(37,211,102,0); }
    }
    .wa-pulse { animation: pulse-grn 2.2s infinite; }

    .faq-body { max-height: 0; overflow: hidden; transition: max-height .38s ease; }
    .faq-body.open { max-height: 320px; }

    #mob-menu { max-height: 0; overflow: hidden; transition: max-height .32s ease; }
    #mob-menu.open { max-height: 500px; }

    .winner-border {
      border-left: 2px solid rgba(212,104,42,.4);
      border-right: 2px solid rgba(212,104,42,.4);
      background: linear-gradient(180deg, rgba(212,104,42,.1) 0%, rgba(212,104,42,.03) 100%);
    }
    .winner-top { border-radius: 12px 12px 0 0; background: linear-gradient(135deg,#D4682A,#B85520); }
    .winner-bot { border-radius: 0 0 12px 12px; }

    .step-num {
      background: linear-gradient(135deg,#D4682A,#B85520);
      box-shadow: 0 8px 32px rgba(212,104,42,.4);
    }

    #intro-overlay {
      position: fixed; inset: 0; z-index: 9999;
      background: #0C0E1A;
      display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 20px;
      animation: overlayOut 0.7s cubic-bezier(0.76,0,0.24,1) 2s forwards;
    }
    @keyframes overlayOut {
      0%   { clip-path: inset(0 0 0 0); }
      100% { clip-path: inset(0 0 100% 0); pointer-events: none; }
    }
    #intro-logo { animation: logoPop 0.9s cubic-bezier(0.175,0.885,0.32,1.275) 0.3s both; }
    @keyframes logoPop {
      0%   { opacity: 0; transform: scale(0.5) translateY(30px); filter: blur(10px); }
      100% { opacity: 1; transform: scale(1) translateY(0); filter: blur(0); }
    }
    #intro-line {
      width: 0; height: 2px;
      background: linear-gradient(90deg, transparent, #D4682A, transparent);
      animation: lineGrow 0.8s ease-out 1s forwards;
    }
    @keyframes lineGrow { to { width: 200px; } }
    #intro-text {
      opacity: 0; font-family: 'Sora',sans-serif; font-size: 12px;
      letter-spacing: 4px; text-transform: uppercase; color: rgba(255,255,255,.4);
      animation: fadeInText 0.6s ease 1.2s forwards;
    }
    @keyframes fadeInText { to { opacity: 1; } }

    #scroll-bar {
      position: fixed; top: 0; left: 0; height: 2px; z-index: 9998;
      background: linear-gradient(90deg, #D4682A, #F4A070);
      width: 0%; will-change: width;
    }

    @keyframes floatA {
      0%,100% { transform: translate(0,0) scale(1); }
      33%      { transform: translate(40px,-30px) scale(1.07); }
      66%      { transform: translate(-20px,20px) scale(0.95); }
    }
    @keyframes floatB {
      0%,100% { transform: translate(0,0); }
      50%      { transform: translate(-35px,40px) scale(1.1); }
    }
    .orb { position: absolute; border-radius: 50%; filter: blur(80px); pointer-events: none; }
    .orb-a { animation: floatA  9s ease-in-out infinite; }
    .orb-b { animation: floatB 13s ease-in-out infinite; }
    .orb-c { animation: floatA 17s ease-in-out infinite reverse; }

    @keyframes shimmer {
      0%   { background-position: -200% center; }
      100% { background-position:  200% center; }
    }
    .text-shimmer {
      background: linear-gradient(90deg, #D4682A 0%, #F4A070 35%, #fff8f5 50%, #F4A070 65%, #D4682A 100%);
      background-size: 200% auto;
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      animation: shimmer 5s linear infinite;
    }

    .card-glare { position: relative; overflow: hidden; }
    .card-glare::after {
      content: '';
      position: absolute; top: -50%; left: -70%;
      width: 45%; height: 200%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,.07), transparent);
      transform: skewX(-20deg);
      transition: left .65s ease;
      pointer-events: none;
    }
    .card-glare:hover::after { left: 130%; }

    .tilt-wrap { transform-style: preserve-3d; will-change: transform; transition: transform .08s linear; }

    .ripple-btn { position: relative; overflow: hidden; }
    .ripple-wave {
      position: absolute; border-radius: 50%;
      transform: scale(0); opacity: 1;
      background: rgba(255,255,255,.22);
      animation: rippleAnim .55s linear;
      pointer-events: none;
    }
    @keyframes rippleAnim { to { transform: scale(5); opacity: 0; } }

    .stat-num { display: inline-block; }

    @keyframes stepGlow {
      0%,100% { box-shadow: 0 8px 32px rgba(212,104,42,.4); }
      50%      { box-shadow: 0 8px 52px rgba(212,104,42,.85), 0 0 0 10px rgba(212,104,42,.12); }
    }
    .step-num { animation: stepGlow 2.8s ease-in-out infinite; }

    #hero-canvas { position: absolute; inset: 0; pointer-events: none; z-index: 1; }
  </style>
</head>
<body class="bg-[#0C0E1A]">

  <!-- INTRO OVERLAY -->
  <div id="intro-overlay">
    <img id="intro-logo" src="<?php echo get_template_directory_uri(); ?>/logo sf branca.png" alt="João do Consórcio" style="height:60px;">
    <div id="intro-line"></div>
    <div id="intro-text">Especialista em Consórcio</div>
  </div>

  <!-- SCROLL PROGRESS -->
  <div id="scroll-bar"></div>

  <!-- WHATSAPP FLOAT -->
  <a href="https://wa.me/5528999693542?text=Ol%C3%A1%20Jo%C3%A3o%2C%20quero%20uma%20simula%C3%A7%C3%A3o%20gratuita!"
     target="_blank"
     class="wa-pulse fixed bottom-6 right-6 z-50 w-16 h-16 bg-[#25D366] rounded-full flex items-center justify-center shadow-2xl hover:scale-110 transition-transform">
    <i class="fab fa-whatsapp text-white text-3xl"></i>
  </a>

  <!-- TOPBAR -->
  <div class="bg-brand-orange text-white text-xs sm:text-sm py-2 px-4 text-center font-medium tracking-wide">
    <i class="fas fa-star mr-1 text-yellow-200 text-xs"></i>
    Consulta 100% gratuita — Atendimento personalizado pelo WhatsApp
    <i class="fas fa-star ml-1 text-yellow-200 text-xs"></i>
  </div>

  <!-- NAVBAR -->
  <nav id="navbar" class="nav-glass sticky top-0 z-40 border-b border-white/5">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
      <img src="<?php echo get_template_directory_uri(); ?>/logo sf branca.png" alt="João do Consórcio" class="h-10 sm:h-12">
      <div class="hidden lg:flex items-center gap-8 text-sm font-medium">
        <a href="#como-funciona" class="text-white/65 hover:text-white transition-colors">Como Funciona</a>
        <a href="#veiculos"      class="text-white/65 hover:text-white transition-colors">Veículos</a>
        <a href="#comparativo"  class="text-white/65 hover:text-white transition-colors">Vantagens</a>
        <a href="#depoimentos"  class="text-white/65 hover:text-white transition-colors">Depoimentos</a>
        <a href="#faq"          class="text-white/65 hover:text-white transition-colors">Dúvidas</a>
      </div>
      <a href="https://wa.me/5528999693542?text=Ol%C3%A1%20Jo%C3%A3o%2C%20quero%20uma%20simula%C3%A7%C3%A3o!"
         class="hidden lg:inline-flex items-center gap-2 bg-brand-orange hover:bg-brand-orangeL text-white px-5 py-2.5 rounded-full text-sm font-bold transition-all hover:scale-105 btn-pulse">
        <i class="fab fa-whatsapp"></i> Falar com João
      </a>
      <button onclick="document.getElementById('mob-menu').classList.toggle('open')"
              class="lg:hidden text-white p-2">
        <i class="fas fa-bars text-xl"></i>
      </button>
    </div>
    <div id="mob-menu" class="lg:hidden bg-[#131628]/95 border-t border-white/5">
      <div class="px-6 py-4 flex flex-col gap-3 text-sm font-medium">
        <a href="#como-funciona" class="text-white/75 hover:text-white py-2 border-b border-white/5">Como Funciona</a>
        <a href="#veiculos"      class="text-white/75 hover:text-white py-2 border-b border-white/5">Veículos</a>
        <a href="#comparativo"  class="text-white/75 hover:text-white py-2 border-b border-white/5">Vantagens</a>
        <a href="#depoimentos"  class="text-white/75 hover:text-white py-2 border-b border-white/5">Depoimentos</a>
        <a href="https://wa.me/5528999693542"
           class="bg-brand-orange text-white py-3 px-6 rounded-full text-center font-bold mt-2">
          <i class="fab fa-whatsapp mr-2"></i>Falar com João
        </a>
      </div>
    </div>
  </nav>

  <!-- HERO -->
  <section class="relative min-h-screen flex items-center overflow-hidden">
    <canvas id="hero-canvas"></canvas>
    <div class="absolute inset-0">
      <img id="hero-img" src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=1920&q=85&fit=crop"
           alt="Veículo premium" class="w-full h-full object-cover object-center" style="will-change:transform;">
      <div class="hero-mask absolute inset-0"></div>
    </div>
    <div class="orb orb-a" style="width:600px;height:600px;background:rgba(212,104,42,.07);top:10%;left:5%;"></div>
    <div class="orb orb-b" style="width:400px;height:400px;background:rgba(27,32,88,.25);bottom:10%;right:10%;"></div>
    <div class="orb orb-c" style="width:300px;height:300px;background:rgba(212,104,42,.05);top:50%;right:30%;"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 py-28 sm:py-36">
      <div class="max-w-3xl">
        <div class="inline-flex items-center gap-2 bg-brand-orange/15 border border-brand-orange/30 text-brand-orange px-4 py-2 rounded-full text-sm font-semibold mb-8"
             data-aos="fade-down">
          <i class="fas fa-shield-alt text-xs"></i>
          Especialista em Contemplação por Lance Fixo
        </div>
        <h1 class="font-display font-bold text-4xl sm:text-5xl lg:text-6xl xl:text-7xl leading-[1.08] mb-6"
            data-aos="fade-up" data-aos-delay="80">
          Algumas conquistas<br>têm um nome.
          <br><span class="text-shimmer">Qual é o do<br>seu próximo veículo?</span>
        </h1>
        <p class="text-lg sm:text-xl text-white/70 leading-relaxed mb-10 max-w-2xl"
           data-aos="fade-up" data-aos-delay="180">
          Consórcio sem juros, com parcelas que cabem no seu bolso — e um especialista que caminha com você até o momento da chave na mão.
        </p>
        <div class="flex flex-col sm:flex-row gap-4" data-aos="fade-up" data-aos-delay="260">
          <a href="https://wa.me/5528999693542?text=Ol%C3%A1%20Jo%C3%A3o%2C%20quero%20minha%20simula%C3%A7%C3%A3o%20gratuita!"
             class="inline-flex items-center justify-center gap-3 bg-brand-orange hover:bg-brand-orangeL text-white px-8 py-4 rounded-full text-lg font-bold transition-all hover:scale-105 shadow-[0_8px_40px_rgba(212,104,42,.45)] btn-pulse">
            <i class="fab fa-whatsapp text-xl"></i>
            Quero minha simulação gratuita
          </a>
          <a href="#como-funciona"
             class="inline-flex items-center justify-center gap-2 border border-white/20 hover:border-brand-orange text-white px-8 py-4 rounded-full text-lg font-medium transition-all hover:bg-white/5">
            Como funciona <i class="fas fa-arrow-down text-sm"></i>
          </a>
        </div>
        <div class="flex flex-wrap items-center gap-6 mt-12" data-aos="fade-up" data-aos-delay="340">
          <span class="flex items-center gap-2 text-sm text-white/45"><i class="fas fa-check-circle text-brand-orange"></i> Zero juros</span>
          <span class="flex items-center gap-2 text-sm text-white/45"><i class="fas fa-check-circle text-brand-orange"></i> Sem entrada obrigatória</span>
          <span class="flex items-center gap-2 text-sm text-white/45"><i class="fas fa-check-circle text-brand-orange"></i> Contemplação todo mês</span>
          <span class="flex items-center gap-2 text-sm text-white/45"><i class="fas fa-check-circle text-brand-orange"></i> 100% online</span>
        </div>
      </div>
    </div>
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-1 text-white/25 text-xs animate-bounce select-none">
      <span>Role para baixo</span>
      <i class="fas fa-chevron-down"></i>
    </div>
  </section>

  <!-- STATS -->
  <section class="bg-[#131628] border-y border-white/5 py-12">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-2 lg:grid-cols-4 gap-8 text-center">
      <div data-aos="fade-up">
        <div class="font-display font-bold text-3xl sm:text-4xl text-brand-orange mb-1">
          +<span class="stat-num" data-target="360" data-suffix="">0</span>
        </div>
        <div class="text-white/45 text-sm">Clientes contemplados</div>
      </div>
      <div data-aos="fade-up" data-aos-delay="80">
        <div class="font-display font-bold text-3xl sm:text-4xl text-brand-orange mb-1">
          <span class="stat-num" data-target="8" data-suffix="+">0</span>
        </div>
        <div class="text-white/45 text-sm">Anos de experiência</div>
      </div>
      <div data-aos="fade-up" data-aos-delay="160">
        <div class="font-display font-bold text-3xl sm:text-4xl text-brand-orange mb-1">R$ 0</div>
        <div class="text-white/45 text-sm">Em juros pagos</div>
      </div>
      <div data-aos="fade-up" data-aos-delay="240">
        <div class="font-display font-bold text-3xl sm:text-4xl text-brand-orange mb-1">4,7 ★</div>
        <div class="text-white/45 text-sm">Avaliação dos clientes</div>
      </div>
    </div>
  </section>

  <!-- SOBRE JOÃO -->
  <section class="py-24 px-6">
    <div class="max-w-6xl mx-auto">
      <div class="grid md:grid-cols-2 gap-12 items-center">
        <div data-aos="fade-right">
          <div class="relative">
            <img src="<?php echo get_template_directory_uri(); ?>/Fotos/WhatsApp Image 2026-06-03 at 14.51.50.jpeg"
                 alt="João Vitor — Fera de Consórcio 2024 · 2025 · 2026"
                 class="w-full rounded-2xl object-cover max-h-[520px] object-top">
            <div class="absolute -bottom-4 -right-4 w-36 h-36 rounded-xl overflow-hidden border-4 border-[#0C0E1A] shadow-2xl hidden sm:block">
              <img src="<?php echo get_template_directory_uri(); ?>/Fotos/WhatsApp Image 2026-04-27 at 16.16.59.jpeg"
                   alt="João Vitor"
                   class="w-full h-full object-cover object-top">
            </div>
            <div class="absolute top-4 left-4 bg-brand-orange text-white text-xs font-bold px-3 py-1.5 rounded-full flex items-center gap-1.5">
              <i class="fas fa-trophy text-yellow-200 text-xs"></i>
              Fera de Consórcio 2024 · 2025 · 2026
            </div>
          </div>
        </div>
        <div data-aos="fade-left">
          <span class="inline-block bg-brand-orange/10 border border-brand-orange/20 text-brand-orange text-sm font-semibold px-4 py-2 rounded-full mb-6">
            Quem é João Vitor?
          </span>
          <h2 class="font-display font-bold text-3xl sm:text-4xl mb-6">
            Um especialista que<br>
            <span class="text-grad">pensa junto com você</span>
          </h2>
          <p class="text-white/60 leading-relaxed mb-4">
            João Vitor é especialista em consórcio de veículos com mais de 8 anos de experiência. Reconhecido como <strong class="text-white">Fera de Consórcio em 2024 e 2025</strong>, ele segue em 1º lugar em 2026 — e já ajudou mais de 360 famílias a realizarem o sonho do veículo próprio sem pagar juros.
          </p>
          <p class="text-white/60 leading-relaxed mb-8">
            Mais do que vender um plano, João caminha ao lado de cada cliente — do primeiro contato até a chave na mão. Com orientação estratégica de lance e acompanhamento personalizado, ele maximiza suas chances de contemplação.
          </p>
          <div class="flex flex-wrap gap-3">
            <div class="flex items-center gap-2 bg-[#131628] border border-white/8 rounded-xl px-4 py-3 text-sm font-medium">
              <i class="fas fa-trophy text-brand-orange"></i> Fera de Consórcio 2024 · 2025 · 2026
            </div>
            <div class="flex items-center gap-2 bg-[#131628] border border-white/8 rounded-xl px-4 py-3 text-sm font-medium">
              <i class="fas fa-users text-brand-orange"></i> +360 contemplados
            </div>
            <div class="flex items-center gap-2 bg-[#131628] border border-white/8 rounded-xl px-4 py-3 text-sm font-medium">
              <i class="fas fa-calendar text-brand-orange"></i> 8+ anos
            </div>
          </div>
          <div class="mt-8">
            <a href="https://wa.me/5528999693542?text=Ol%C3%A1%20Jo%C3%A3o%2C%20quero%20uma%20simula%C3%A7%C3%A3o%20gratuita!"
               class="inline-flex items-center gap-2 bg-brand-orange hover:bg-brand-orangeL text-white px-7 py-3.5 rounded-full font-bold text-sm transition-all hover:scale-105">
              <i class="fab fa-whatsapp"></i> Falar com João
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- VEHICLES -->
  <section id="veiculos" class="py-24 px-6">
    <div class="max-w-7xl mx-auto">
      <div class="text-center mb-16" data-aos="fade-up">
        <span class="inline-block bg-brand-orange/10 border border-brand-orange/20 text-brand-orange text-sm font-semibold px-4 py-2 rounded-full mb-4">
          Portfólio completo
        </span>
        <h2 class="font-display font-bold text-3xl sm:text-4xl lg:text-5xl mb-4">
          Qual veículo você está<br>
          <span class="text-grad">pronto para conquistar?</span>
        </h2>
        <p class="text-white/50 text-lg max-w-2xl mx-auto">
          Do carro popular ao SUV premium, da moto urbana à big trail — João tem o plano certo para você.
        </p>
      </div>
      <div class="veic-track flex md:grid md:grid-cols-3 gap-5 md:gap-6 overflow-x-auto md:overflow-visible snap-x snap-mandatory no-scrollbar -mx-6 px-6 md:mx-0 md:px-0 pb-2 md:pb-0">
        <div class="card-lift tilt-wrap bg-[#131628] border border-white/8 rounded-2xl overflow-hidden" data-aos="fade-up" data-aos-delay="0">
          <div class="card-glare relative h-52 overflow-hidden">
            <img src="https://images.unsplash.com/photo-1494976388531-d1058494cdd8?w=800&q=80&fit=crop" alt="Automóveis" class="w-full h-full object-cover transition-transform duration-500 hover:scale-108">
            <div class="absolute inset-0 bg-gradient-to-t from-[#131628] via-transparent to-transparent"></div>
            <span class="absolute top-4 left-4 bg-brand-orange/90 text-white text-xs font-bold px-3 py-1.5 rounded-full">MAIS PROCURADO</span>
          </div>
          <div class="p-6">
            <div class="flex items-center gap-2 mb-3"><i class="fas fa-car text-brand-orange text-lg"></i><h3 class="font-display font-bold text-xl">Automóveis</h3></div>
            <p class="text-white/50 text-sm mb-5 leading-relaxed">Populares, sedãs, SUVs e pickups. De entrada a veículos premium — você escolhe o modelo após a contemplação.</p>
            <div class="border-t border-white/8 pt-4 mb-5">
              <div class="text-xs text-white/35 mb-1">Crédito a partir de</div>
              <div class="font-display font-bold text-2xl text-white">R$ 60.000</div>
              <div class="text-xs text-white/35 mt-0.5">Parcelas a partir de R$ 700/mês</div>
            </div>
            <a href="https://wa.me/5528999693542?text=Quero%20simular%20cons%C3%B3rcio%20de%20carros!"
               class="w-full flex items-center justify-center gap-2 border border-brand-orange/30 hover:bg-brand-orange text-brand-orange hover:text-white py-3 rounded-xl text-sm font-semibold transition-all">
              Simular agora <i class="fas fa-arrow-right text-xs"></i>
            </a>
          </div>
        </div>
        <div class="card-lift tilt-wrap bg-[#131628] border border-white/8 rounded-2xl overflow-hidden" data-aos="fade-up" data-aos-delay="100">
          <div class="card-glare relative h-52 overflow-hidden">
            <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&q=80&fit=crop" alt="Motocicletas" class="w-full h-full object-cover transition-transform duration-500 hover:scale-108">
            <div class="absolute inset-0 bg-gradient-to-t from-[#131628] via-transparent to-transparent"></div>
          </div>
          <div class="p-6">
            <div class="flex items-center gap-2 mb-3"><i class="fas fa-motorcycle text-brand-orange text-lg"></i><h3 class="font-display font-bold text-xl">Motocicletas</h3></div>
            <p class="text-white/50 text-sm mb-5 leading-relaxed">Esportivas, trail, big trails e modelos 400cc para cima. Para trabalho, aventura ou paixão sobre duas rodas.</p>
            <div class="border-t border-white/8 pt-4 mb-5">
              <div class="text-xs text-white/35 mb-1">Crédito a partir de</div>
              <div class="font-display font-bold text-2xl text-white">R$ 40.000</div>
              <div class="text-xs text-white/35 mt-0.5">Parcelas a partir de R$ 500/mês</div>
            </div>
            <a href="https://wa.me/5528999693542?text=Quero%20simular%20cons%C3%B3rcio%20de%20motos!"
               class="w-full flex items-center justify-center gap-2 border border-brand-orange/30 hover:bg-brand-orange text-brand-orange hover:text-white py-3 rounded-xl text-sm font-semibold transition-all">
              Simular agora <i class="fas fa-arrow-right text-xs"></i>
            </a>
          </div>
        </div>
        <div class="card-lift tilt-wrap bg-[#131628] border border-white/8 rounded-2xl overflow-hidden" data-aos="fade-up" data-aos-delay="200">
          <div class="card-glare relative h-52 overflow-hidden">
            <img src="https://images.unsplash.com/photo-1601584115197-04ecc0da31d7?w=800&q=80&fit=crop" alt="Caminhões" class="w-full h-full object-cover transition-transform duration-500 hover:scale-108">
            <div class="absolute inset-0 bg-gradient-to-t from-[#131628] via-transparent to-transparent"></div>
            <span class="absolute top-4 left-4 bg-[#1B2058]/90 border border-white/20 text-white text-xs font-bold px-3 py-1.5 rounded-full">PARA EMPRESAS</span>
          </div>
          <div class="p-6">
            <div class="flex items-center gap-2 mb-3"><i class="fas fa-truck text-brand-orange text-lg"></i><h3 class="font-display font-bold text-xl">Caminhões & Pesados</h3></div>
            <p class="text-white/50 text-sm mb-5 leading-relaxed">Frota para autônomos e empresas. Leves, médios e pesados — créditos flexíveis para expandir seu negócio.</p>
            <div class="border-t border-white/8 pt-4 mb-5">
              <div class="text-xs text-white/35 mb-1">Crédito a partir de</div>
              <div class="font-display font-bold text-2xl text-white">R$ 150.000</div>
              <div class="text-xs text-white/35 mt-0.5">Parcelas a partir de R$ 1.767/mês</div>
            </div>
            <a href="https://wa.me/5528999693542?text=Quero%20simular%20cons%C3%B3rcio%20de%20caminh%C3%B5es!"
               class="w-full flex items-center justify-center gap-2 border border-brand-orange/30 hover:bg-brand-orange text-brand-orange hover:text-white py-3 rounded-xl text-sm font-semibold transition-all">
              Simular agora <i class="fas fa-arrow-right text-xs"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="comparativo" class="py-24 px-6">
    <div class="max-w-5xl mx-auto">

      <div class="text-center mb-12" data-aos="fade-up">
        <span class="inline-block bg-brand-orange/10 border border-brand-orange/20 text-brand-orange text-sm font-semibold px-4 py-2 rounded-full mb-4">
          Simulador de Economia
        </span>
        <h2 class="font-display font-bold text-3xl sm:text-4xl lg:text-5xl mb-3">
          Simule e veja a diferença<br><span class="text-grad">nos números reais</span>
        </h2>
        <p class="text-white/50 text-lg">Escolha o tipo de bem, o crédito e o prazo</p>
      </div>

      <!-- TIPO -->
      <div class="flex justify-center gap-3 mb-8" data-aos="fade-up">
        <button id="sim-btn-veiculo" type="button" onclick="simSetTipo('veiculo')"
          class="flex items-center gap-2 px-7 py-3.5 rounded-full font-bold text-sm border-2 transition-all duration-200">
          <i class="fas fa-car"></i> Veículo
        </button>
        <button id="sim-btn-imovel" type="button" onclick="simSetTipo('imovel')"
          class="flex items-center gap-2 px-7 py-3.5 rounded-full font-bold text-sm border-2 transition-all duration-200">
          <i class="fas fa-house"></i> Imóvel
        </button>
      </div>

      <!-- VALORES -->
      <div class="mb-8 text-center" data-aos="fade-up">
        <p class="text-white/40 text-xs uppercase tracking-widest mb-4 font-medium">Valor do crédito</p>
        <div id="sim-valores" class="flex flex-wrap gap-2 justify-center"></div>
      </div>

      <!-- PRAZO -->
      <div class="mb-10 text-center" data-aos="fade-up">
        <p class="text-white/40 text-xs uppercase tracking-widest mb-2 font-medium">Prazo do financiamento</p>
        <p id="sim-prazo-hint" class="text-white/30 text-xs mb-4 max-w-md mx-auto">O consórcio é sempre dividido em até <span class="text-brand-orange font-semibold">84x</span> — escolha o prazo do financiamento para comparar.</p>
        <div id="sim-prazos" class="inline-flex flex-wrap justify-center max-w-full bg-[#131628] border border-white/8 rounded-full p-1 gap-1"></div>
      </div>

      <!-- RESULTADO -->
      <div class="grid md:grid-cols-2 gap-5 mb-5" data-aos="fade-up">

        <!-- FINANCIAMENTO -->
        <div class="bg-white/[0.03] border border-white/10 rounded-2xl overflow-hidden">
          <div class="bg-[#131628] px-6 py-4 flex items-center gap-3 border-b border-white/8">
            <div class="w-8 h-8 rounded-full bg-red-500/10 border border-red-500/20 flex items-center justify-center flex-shrink-0">
              <i class="fas fa-times text-red-400 text-xs"></i>
            </div>
            <div class="flex-1 flex items-center justify-between gap-2">
              <div>
                <span class="font-display font-bold text-base block">Financiamento Tradicional</span>
                <span class="text-white/40 text-xs font-medium">Prazo limitado a 60 meses</span>
              </div>
              <span class="flex-shrink-0 text-xs bg-red-500/10 text-red-400/80 border border-red-500/20 px-2.5 py-1 rounded-full font-bold tracking-wide">LIMITADO</span>
            </div>
          </div>
          <div class="p-6">
            <div class="flex justify-between items-center py-3.5 border-b border-white/5">
              <span class="text-white/50 text-sm">Parcela / mês</span>
              <span id="sim-fin-parcela" class="font-display font-bold text-xl text-red-400 tabular-nums">—</span>
            </div>
            <div class="flex justify-between items-center py-3.5 border-b border-white/5">
              <span class="text-white/50 text-sm">Taxa de juros</span>
              <span id="sim-fin-taxa-label" class="text-red-400 font-semibold text-sm">3% ao mês</span>
            </div>
            <div class="flex justify-between items-center py-3.5 border-b border-white/5">
              <span class="text-white/50 text-sm">Prazo máximo</span>
              <span class="text-red-400/80 font-semibold text-sm flex items-center gap-1.5"><i class="fas fa-lock text-xs opacity-70"></i> 60 meses</span>
            </div>
            <div class="flex justify-between items-center py-3.5 border-b border-white/5">
              <span class="text-white/50 text-sm">Total em juros</span>
              <span id="sim-fin-juros" class="text-red-400 font-semibold text-sm tabular-nums">—</span>
            </div>
            <div class="flex justify-between items-center py-3.5">
              <span class="text-white/70 text-sm font-semibold">Total pago</span>
              <span id="sim-fin-total" class="font-display font-bold text-2xl text-red-400 tabular-nums">—</span>
            </div>
          </div>
        </div>

        <!-- CONSÓRCIO -->
        <div class="bg-brand-orange/5 border border-brand-orange/30 rounded-2xl overflow-hidden">
          <div class="bg-gradient-to-r from-brand-orange to-brand-orangeL px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-2">
              <i class="fas fa-trophy text-yellow-300 text-sm"></i>
              <div>
                <span class="font-display font-bold text-base block">Consórcio João Vitor</span>
                <span class="text-white/85 text-xs font-semibold flex items-center gap-1"><i class="fas fa-calendar-check text-white/70 text-xs"></i> <span id="sim-con-prazo-header">Parcelado em até 84x</span></span>
              </div>
            </div>
            <span class="bg-white/25 text-white text-xs font-bold px-2.5 py-1 rounded-full">MELHOR OPÇÃO</span>
          </div>
          <div class="p-6">
            <div id="sim-con-row-antes" class="flex justify-between items-center py-3.5 border-b border-brand-orange/10">
              <span id="sim-con-antes-label" class="text-white/50 text-sm">Parcela em 84x</span>
              <span id="sim-con-antes" class="font-display font-bold text-xl text-green-400 tabular-nums">—</span>
            </div>
            <div id="sim-con-row-apos" class="flex justify-between items-center py-3.5 border-b border-brand-orange/10">
              <span id="sim-con-parcela-label" class="text-white/50 text-sm">Após contemplação</span>
              <span id="sim-con-parcela" class="font-display font-bold text-base text-green-400/80 tabular-nums">—</span>
            </div>
            <div class="flex justify-between items-center py-3.5 border-b border-brand-orange/10">
              <span class="text-white/50 text-sm">Juros</span>
              <span class="text-green-400 font-semibold text-sm">0% de juros</span>
            </div>
            <div class="flex justify-between items-center py-3.5 border-b border-brand-orange/10">
              <span class="text-white/50 text-sm">Taxa administrativa</span>
              <span id="sim-con-taxa-label" class="text-brand-orange font-semibold text-sm">16% total</span>
            </div>
            <div class="flex justify-between items-center py-3.5 border-b border-brand-orange/10">
              <span class="text-white/50 text-sm">Prazo disponível</span>
              <span class="text-green-400 font-semibold text-sm flex items-center gap-1.5"><i class="fas fa-arrow-up text-xs"></i> <span id="sim-con-prazo-label">Em até 84x</span></span>
            </div>
            <div class="flex justify-between items-center py-3.5">
              <span class="text-white/70 text-sm font-semibold">Total pago</span>
              <span id="sim-con-total" class="font-display font-bold text-2xl text-green-400 tabular-nums">—</span>
            </div>
          </div>
        </div>
      </div>

      <!-- ECONOMIA -->
      <div class="bg-green-500/8 border border-green-500/20 rounded-2xl p-6 flex flex-col sm:flex-row items-center justify-between gap-5" data-aos="fade-up">
        <div class="flex items-center gap-4">
          <div class="w-14 h-14 bg-green-500/15 rounded-xl flex items-center justify-center flex-shrink-0">
            <i class="fas fa-piggy-bank text-green-400 text-2xl"></i>
          </div>
          <div>
            <div id="sim-economia-label" class="text-white/50 text-sm mb-1">Com o consórcio, você economiza</div>
            <div id="sim-economia-val" class="font-display font-bold text-3xl sm:text-4xl text-green-400 tabular-nums">—</div>
          </div>
        </div>
        <a href="https://wa.me/5528999693542?text=Ol%C3%A1%20Jo%C3%A3o!%20Quero%20uma%20simula%C3%A7%C3%A3o%20gratuita!"
           class="flex-shrink-0 inline-flex items-center gap-2 bg-brand-orange hover:bg-brand-orangeL text-white px-7 py-3.5 rounded-full font-bold text-sm transition-all hover:scale-105">
          <i class="fab fa-whatsapp text-base"></i> Simular com João
        </a>
      </div>

      <p id="sim-footnote" class="text-center text-white/25 text-xs mt-4">*Taxa de referência: 3% a.m. (financiamento). Taxa administrativa do consórcio: 16% total. Valores aproximados para fins ilustrativos.</p>
    </div>
  </section>

  <!-- PROBLEM -->
  <section class="py-24 px-6">
    <div class="max-w-5xl mx-auto">
      <div class="text-center mb-14" data-aos="fade-up">
        <h2 class="font-display font-bold text-3xl sm:text-4xl lg:text-5xl mb-5">
          No financiamento você pode pagar<br>
          <span class="text-grad">até 2× o valor do carro</span>
        </h2>
        <p class="text-white/55 text-lg max-w-2xl mx-auto leading-relaxed">
          A maioria das pessoas não percebe o quanto paga em juros. Existe uma alternativa mais inteligente — e poucos conhecem.
        </p>
      </div>
      <div class="grid md:grid-cols-2 gap-6">
        <div class="bg-white/[0.03] border border-white/8 rounded-2xl p-8" data-aos="fade-right">
          <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 rounded-full bg-red-500/10 border border-red-500/20 flex items-center justify-center flex-shrink-0">
              <i class="fas fa-times text-red-400 text-sm"></i>
            </div>
            <h3 class="font-display font-bold text-xl">Financiamento tradicional</h3>
          </div>
          <ul class="space-y-4 text-sm">
            <li class="flex items-start gap-3 text-white/55">
              <i class="fas fa-times-circle text-red-400 mt-0.5 flex-shrink-0"></i>
              <span>Juros de até <strong class="text-white">25% ao ano</strong> — você paga muito mais que o valor do veículo</span>
            </li>
            <li class="flex items-start gap-3 text-white/55">
              <i class="fas fa-times-circle text-red-400 mt-0.5 flex-shrink-0"></i>
              <span>Entrada alta que imobiliza seu capital</span>
            </li>
            <li class="flex items-start gap-3 text-white/55">
              <i class="fas fa-times-circle text-red-400 mt-0.5 flex-shrink-0"></i>
              <span>Parcelas pesadas que sufocam o orçamento por anos</span>
            </li>
            <li class="flex items-start gap-3 text-white/55">
              <i class="fas fa-times-circle text-red-400 mt-0.5 flex-shrink-0"></i>
              <span>Você fica refém do banco do início ao fim</span>
            </li>
          </ul>
        </div>
        <div class="bg-brand-orange/5 border border-brand-orange/20 rounded-2xl p-8" data-aos="fade-left">
          <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 rounded-full bg-brand-orange/15 border border-brand-orange/30 flex items-center justify-center flex-shrink-0">
              <i class="fas fa-check text-brand-orange text-sm"></i>
            </div>
            <h3 class="font-display font-bold text-xl">Consórcio com João Vitor</h3>
          </div>
          <ul class="space-y-4 text-sm">
            <li class="flex items-start gap-3 text-white/65">
              <i class="fas fa-check-circle text-brand-orange mt-0.5 flex-shrink-0"></i>
              <span><strong class="text-white">Zero juros.</strong> Só uma pequena taxa administrativa — economia de até R$ 40.000</span>
            </li>
            <li class="flex items-start gap-3 text-white/65">
              <i class="fas fa-check-circle text-brand-orange mt-0.5 flex-shrink-0"></i>
              <span>Sem entrada obrigatória — preserve seu capital</span>
            </li>
            <li class="flex items-start gap-3 text-white/65">
              <i class="fas fa-check-circle text-brand-orange mt-0.5 flex-shrink-0"></i>
              <span>Parcelas que cabem no seu orçamento real</span>
            </li>
            <li class="flex items-start gap-3 text-white/65">
              <i class="fas fa-check-circle text-brand-orange mt-0.5 flex-shrink-0"></i>
              <span>Um especialista ao seu lado até a chave na mão</span>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- HOW IT WORKS -->
  <section id="como-funciona" class="py-24 px-6 bg-[#131628]/50">
    <div class="max-w-6xl mx-auto">
      <div class="text-center mb-16" data-aos="fade-up">
        <span class="inline-block bg-brand-orange/10 border border-brand-orange/20 text-brand-orange text-sm font-semibold px-4 py-2 rounded-full mb-4">
          Simples assim
        </span>
        <h2 class="font-display font-bold text-3xl sm:text-4xl lg:text-5xl">
          Como funciona o consórcio
        </h2>
      </div>
      <div class="grid md:grid-cols-3 gap-10 relative">
        <div class="hidden md:block absolute top-[52px] left-[calc(33.33%+24px)] right-[calc(33.33%+24px)] h-px bg-gradient-to-r from-brand-orange/50 via-brand-orange/20 to-brand-orange/50"></div>
        <div class="text-center" data-aos="fade-up" data-aos-delay="0">
          <div class="step-num w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-8 font-display font-bold text-3xl text-white relative z-10">1</div>
          <h3 class="font-display font-bold text-xl mb-3">Escolha seu crédito</h3>
          <p class="text-white/55 text-sm leading-relaxed">Você define o valor que precisa para o veículo. Com João, você encontra o plano certo para o seu bolso e seu objetivo.</p>
        </div>
        <div class="text-center" data-aos="fade-up" data-aos-delay="120">
          <div class="step-num w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-8 font-display font-bold text-3xl text-white relative z-10">2</div>
          <h3 class="font-display font-bold text-xl mb-3">Pague sem juros</h3>
          <p class="text-white/55 text-sm leading-relaxed">Parcelas mensais sem taxa de juros. Apenas uma taxa administrativa. Seu dinheiro trabalha para você, não para o banco.</p>
        </div>
        <div class="text-center" data-aos="fade-up" data-aos-delay="240">
          <div class="step-num w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-8 font-display font-bold text-3xl text-white relative z-10">3</div>
          <h3 class="font-display font-bold text-xl mb-3">Seja contemplado</h3>
          <p class="text-white/55 text-sm leading-relaxed">Por sorteio todo mês ou por lance. Contemplado, você usa a carta de crédito para comprar qualquer veículo da categoria.</p>
        </div>
      </div>
      <div class="mt-14 bg-brand-orange/5 border border-brand-orange/20 rounded-2xl p-6 flex flex-col sm:flex-row items-center gap-4" data-aos="fade-up">
        <div class="w-12 h-12 bg-brand-orange/15 rounded-xl flex items-center justify-center flex-shrink-0">
          <i class="fas fa-lightbulb text-brand-orange text-xl"></i>
        </div>
        <div>
          <strong class="text-white block mb-1">Dica do João Vitor:</strong>
          <p class="text-white/60 text-sm leading-relaxed">
            Com o recurso do <strong class="text-brand-orange">lance</strong>, você oferece um valor adicional e, se for o maior, é contemplado naquele mês — sem esperar o sorteio. João te orienta em toda a estratégia de lance.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- BENEFITS -->
  <section id="beneficios" class="py-24 px-6 bg-[#131628]/50">
    <div class="max-w-7xl mx-auto">
      <div class="text-center mb-14" data-aos="fade-up">
        <h2 class="font-display font-bold text-3xl sm:text-4xl lg:text-5xl mb-4">
          Por que consórcio<br><span class="text-grad">com João Vitor?</span>
        </h2>
      </div>
      <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="card-lift bg-[#131628] border border-white/8 rounded-2xl p-6" data-aos="fade-up" data-aos-delay="0">
          <div class="w-12 h-12 bg-brand-orange/10 rounded-xl flex items-center justify-center mb-5"><i class="fas fa-percentage text-brand-orange text-xl"></i></div>
          <h3 class="font-display font-bold text-lg mb-3">Zero Juros</h3>
          <p class="text-white/50 text-sm leading-relaxed">Sem juros no consórcio. Apenas uma taxa administrativa distribuída no prazo — economia real de milhares de reais comparado ao financiamento.</p>
        </div>
        <div class="card-lift bg-[#131628] border border-white/8 rounded-2xl p-6" data-aos="fade-up" data-aos-delay="80">
          <div class="w-12 h-12 bg-brand-orange/10 rounded-xl flex items-center justify-center mb-5"><i class="fas fa-calendar-check text-brand-orange text-xl"></i></div>
          <h3 class="font-display font-bold text-lg mb-3">Contemplação Todo Mês</h3>
          <p class="text-white/50 text-sm leading-relaxed">Sorteios mensais em todos os grupos. Com a estratégia certa de lance, João ajuda você a antecipar a contemplação.</p>
        </div>
        <div class="card-lift bg-[#131628] border border-white/8 rounded-2xl p-6" data-aos="fade-up" data-aos-delay="160">
          <div class="w-12 h-12 bg-brand-orange/10 rounded-xl flex items-center justify-center mb-5"><i class="fas fa-shield-halved text-brand-orange text-xl"></i></div>
          <h3 class="font-display font-bold text-lg mb-3">100% Regulamentado</h3>
          <p class="text-white/50 text-sm leading-relaxed">Administradoras autorizadas pelo Banco Central do Brasil. Seu investimento é seguro, auditado e garantido por lei.</p>
        </div>
        <div class="card-lift bg-[#131628] border border-white/8 rounded-2xl p-6" data-aos="fade-up" data-aos-delay="0">
          <div class="w-12 h-12 bg-brand-orange/10 rounded-xl flex items-center justify-center mb-5"><i class="fas fa-sliders text-brand-orange text-xl"></i></div>
          <h3 class="font-display font-bold text-lg mb-3">Planos Flexíveis</h3>
          <p class="text-white/50 text-sm leading-relaxed">De 12 a 100 meses. Créditos de R$ 40.000 a R$ 500.000+. Você monta o plano que faz sentido para a sua realidade.</p>
        </div>
        <div class="card-lift bg-[#131628] border border-white/8 rounded-2xl p-6" data-aos="fade-up" data-aos-delay="80">
          <div class="w-12 h-12 bg-brand-orange/10 rounded-xl flex items-center justify-center mb-5"><i class="fas fa-user-tie text-brand-orange text-xl"></i></div>
          <h3 class="font-display font-bold text-lg mb-3">Consultoria Especializada</h3>
          <p class="text-white/50 text-sm leading-relaxed">João Vitor acompanha do plano à entrega da chave. Você não está sozinho em nenhum momento do processo.</p>
        </div>
        <div class="card-lift bg-[#131628] border border-white/8 rounded-2xl p-6" data-aos="fade-up" data-aos-delay="160">
          <div class="w-12 h-12 bg-brand-orange/10 rounded-xl flex items-center justify-center mb-5"><i class="fas fa-mobile-screen text-brand-orange text-xl"></i></div>
          <h3 class="font-display font-bold text-lg mb-3">100% Online</h3>
          <p class="text-white/50 text-sm leading-relaxed">Simulação, contratação e acompanhamento totalmente pelo WhatsApp. Sem filas, sem papelada desnecessária.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- TESTIMONIALS -->
  <section id="depoimentos" class="py-24 px-6 bg-[#131628]/50">
    <div class="max-w-7xl mx-auto">
      <div class="text-center mb-14" data-aos="fade-up">
        <span class="inline-block bg-brand-orange/10 border border-brand-orange/20 text-brand-orange text-sm font-semibold px-4 py-2 rounded-full mb-4">
          Quem já realizou o sonho
        </span>
        <h2 class="font-display font-bold text-3xl sm:text-4xl lg:text-5xl">
          João Vitor caminhou com eles<br><span class="text-grad">até a chave na mão</span>
        </h2>
      </div>

      <div class="bg-brand-orange/5 border border-brand-orange/25 rounded-2xl overflow-hidden mb-8" data-aos="fade-up">
        <div class="flex flex-col md:flex-row">
          <div class="md:w-52 flex-shrink-0 overflow-hidden">
            <img src="<?php echo get_template_directory_uri(); ?>/WhatsApp Image 2026-03-25 at 20.40.39.jpeg"
                 alt="Depoimento Dalva Lima no WhatsApp"
                 class="w-full h-64 md:h-full object-cover object-top">
          </div>
          <div class="p-7 flex flex-col justify-center">
            <div class="flex gap-1 mb-3">
              <i class="fas fa-star text-yellow-400 text-sm"></i>
              <i class="fas fa-star text-yellow-400 text-sm"></i>
              <i class="fas fa-star text-yellow-400 text-sm"></i>
              <i class="fas fa-star text-yellow-400 text-sm"></i>
              <i class="fas fa-star text-yellow-400 text-sm"></i>
            </div>
            <div class="text-5xl text-brand-orange/25 font-serif leading-none mb-1 select-none">"</div>
            <p class="text-white/80 text-base leading-relaxed italic mb-5">
              Algumas conquistas têm nome... e essa tem o seu, João Vitor! Obrigada por toda dedicação, paciência, suporte e carinho em cada etapa desse consórcio. Você não vendeu apenas um sonho, você caminhou comigo até ele se tornar realidade! E as flores... foram o toque final de um atendimento simplesmente inesquecível. Gratidão por tudo!
            </p>
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 bg-brand-orange/20 rounded-full flex items-center justify-center flex-shrink-0">
                <i class="fas fa-user text-brand-orange text-sm"></i>
              </div>
              <div>
                <div class="font-bold text-white">Dalva Lima</div>
                <div class="text-white/40 text-xs">Cliente contemplada ✅ — mensagem real no WhatsApp</div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="mb-8" data-aos="fade-up" data-aos-delay="80">
        <p class="text-center text-white/40 text-sm mb-5 uppercase tracking-widest font-medium">Galeria de contemplações reais</p>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
          <div class="relative overflow-hidden rounded-2xl aspect-square group cursor-pointer">
            <img src="<?php echo get_template_directory_uri(); ?>/Fotos/WhatsApp Image 2026-04-10 at 16.57.22.jpeg" alt="Contemplação — Hyundai HB20" class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-transparent to-transparent"></div>
            <div class="absolute bottom-0 left-0 right-0 p-3">
              <div class="text-xs text-brand-orange font-bold uppercase tracking-wide">Contemplada ✓</div>
              <div class="text-sm text-white font-semibold">Hyundai HB20</div>
            </div>
          </div>
          <div class="relative overflow-hidden rounded-2xl aspect-square group cursor-pointer">
            <img src="<?php echo get_template_directory_uri(); ?>/Fotos/WhatsApp Image 2026-04-10 at 16.57.23 (1).jpeg" alt="Entrega das chaves — Chevrolet Onix" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-transparent to-transparent"></div>
            <div class="absolute bottom-0 left-0 right-0 p-3">
              <div class="text-xs text-brand-orange font-bold uppercase tracking-wide">Entrega 🔑</div>
              <div class="text-sm text-white font-semibold">Chevrolet Onix</div>
            </div>
          </div>
          <div class="relative overflow-hidden rounded-2xl aspect-square group cursor-pointer">
            <img src="<?php echo get_template_directory_uri(); ?>/Fotos/WhatsApp Image 2026-04-10 at 16.57.23.jpeg" alt="Contemplação — Hyundai HB20" class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-transparent to-transparent"></div>
            <div class="absolute bottom-0 left-0 right-0 p-3">
              <div class="text-xs text-brand-orange font-bold uppercase tracking-wide">Contemplado ✓</div>
              <div class="text-sm text-white font-semibold">Hyundai HB20</div>
            </div>
          </div>
        </div>
      </div>

      <div class="flex flex-col sm:flex-row items-center justify-center gap-4 text-center" data-aos="fade-up">
        <div class="flex -space-x-3">
          <div class="w-10 h-10 bg-brand-orange/20 border-2 border-[#131628] rounded-full flex items-center justify-center"><i class="fas fa-user text-brand-orange text-xs"></i></div>
          <div class="w-10 h-10 bg-brand-orange/30 border-2 border-[#131628] rounded-full flex items-center justify-center"><i class="fas fa-user text-brand-orange text-xs"></i></div>
          <div class="w-10 h-10 bg-brand-orange/20 border-2 border-[#131628] rounded-full flex items-center justify-center"><i class="fas fa-user text-brand-orange text-xs"></i></div>
          <div class="w-10 h-10 bg-[#1B2058] border-2 border-[#131628] rounded-full flex items-center justify-center text-white text-xs font-bold">+360</div>
        </div>
        <p class="text-white/55 text-sm">Mais de <strong class="text-white">360 clientes contemplados</strong> confiam no João do Consórcio</p>
      </div>
    </div>
  </section>

  <!-- FAQ -->
  <section id="faq" class="py-24 px-6">
    <div class="max-w-3xl mx-auto">
      <div class="text-center mb-14" data-aos="fade-up">
        <h2 class="font-display font-bold text-3xl sm:text-4xl lg:text-5xl mb-3">Perguntas frequentes</h2>
        <p class="text-white/50 text-lg">João responde as dúvidas mais comuns</p>
      </div>
      <div class="space-y-3" data-aos="fade-up">
        <div class="faq-item bg-[#131628] border border-white/8 rounded-2xl overflow-hidden">
          <button class="w-full flex items-center justify-between p-5 text-left font-semibold text-sm sm:text-base hover:text-brand-orange transition-colors" onclick="toggleFaq(this)">
            <span>O consórcio é seguro? Como funciona a regulamentação?</span>
            <i class="fas fa-plus faq-icon text-brand-orange text-sm flex-shrink-0 ml-4 transition-transform duration-300"></i>
          </button>
          <div class="faq-body px-5">
            <p class="text-white/55 text-sm leading-relaxed pb-5">Sim, totalmente. O consórcio é regulamentado e fiscalizado pelo <strong class="text-white">Banco Central do Brasil (BACEN)</strong>. As administradoras são autorizadas e auditadas regularmente. Trabalhamos apenas com administradoras de grande porte e reputação sólida.</p>
          </div>
        </div>
        <div class="faq-item bg-[#131628] border border-white/8 rounded-2xl overflow-hidden">
          <button class="w-full flex items-center justify-between p-5 text-left font-semibold text-sm sm:text-base hover:text-brand-orange transition-colors" onclick="toggleFaq(this)">
            <span>Quando vou ser contemplado?</span>
            <i class="fas fa-plus faq-icon text-brand-orange text-sm flex-shrink-0 ml-4 transition-transform duration-300"></i>
          </button>
          <div class="faq-body px-5">
            <p class="text-white/55 text-sm leading-relaxed pb-5">Sorteios acontecem todo mês. Você pode ser contemplado no 1° mês ou no último. Com o recurso do <strong class="text-brand-orange">lance</strong>, você oferece um valor adicional e, sendo o maior lance, é contemplado naquele mês — sem depender de sorte. João orienta na estratégia certa.</p>
          </div>
        </div>
        <div class="faq-item bg-[#131628] border border-white/8 rounded-2xl overflow-hidden">
          <button class="w-full flex items-center justify-between p-5 text-left font-semibold text-sm sm:text-base hover:text-brand-orange transition-colors" onclick="toggleFaq(this)">
            <span>Posso usar o crédito em qualquer veículo?</span>
            <i class="fas fa-plus faq-icon text-brand-orange text-sm flex-shrink-0 ml-4 transition-transform duration-300"></i>
          </button>
          <div class="faq-body px-5">
            <p class="text-white/55 text-sm leading-relaxed pb-5">Sim! Após a contemplação você usa a carta de crédito em qualquer veículo dentro da categoria contratada — você escolhe a marca, o modelo e o revendedor. Sem restrição.</p>
          </div>
        </div>
        <div class="faq-item bg-[#131628] border border-white/8 rounded-2xl overflow-hidden">
          <button class="w-full flex items-center justify-between p-5 text-left font-semibold text-sm sm:text-base hover:text-brand-orange transition-colors" onclick="toggleFaq(this)">
            <span>E se eu precisar cancelar? Perco o dinheiro?</span>
            <i class="fas fa-plus faq-icon text-brand-orange text-sm flex-shrink-0 ml-4 transition-transform duration-300"></i>
          </button>
          <div class="faq-body px-5">
            <p class="text-white/55 text-sm leading-relaxed pb-5">Não. Em caso de cancelamento, você recebe de volta os valores pagos (descontada a taxa administrativa), por sorteio junto com contemplados mensais ou no encerramento do grupo. Seu dinheiro é protegido pela regulamentação do BACEN.</p>
          </div>
        </div>
        <div class="faq-item bg-[#131628] border border-white/8 rounded-2xl overflow-hidden">
          <button class="w-full flex items-center justify-between p-5 text-left font-semibold text-sm sm:text-base hover:text-brand-orange transition-colors" onclick="toggleFaq(this)">
            <span>Quais documentos preciso para entrar?</span>
            <i class="fas fa-plus faq-icon text-brand-orange text-sm flex-shrink-0 ml-4 transition-transform duration-300"></i>
          </button>
          <div class="faq-body px-5">
            <p class="text-white/55 text-sm leading-relaxed pb-5">Para contratar: RG ou CNH, CPF e comprovante de renda. Para a contemplação, pode ser solicitada análise de crédito complementar. João te guia em cada passo sem burocracia desnecessária.</p>
          </div>
        </div>
        <div class="faq-item bg-[#131628] border border-white/8 rounded-2xl overflow-hidden">
          <button class="w-full flex items-center justify-between p-5 text-left font-semibold text-sm sm:text-base hover:text-brand-orange transition-colors" onclick="toggleFaq(this)">
            <span>Como é calculada a parcela do consórcio?</span>
            <i class="fas fa-plus faq-icon text-brand-orange text-sm flex-shrink-0 ml-4 transition-transform duration-300"></i>
          </button>
          <div class="faq-body px-5">
            <p class="text-white/55 text-sm leading-relaxed pb-5">A parcela é o valor do crédito dividido pelo prazo, mais a taxa de administração (em média 12-18% diluída no plano inteiro). Sem juros. João faz a simulação personalizada e gratuita para você ver se encaixa na sua realidade.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- FINAL CTA -->
  <section id="contato" class="py-28 px-6 relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-brand-orange/12 via-[#0C0E1A] to-brand-navy/25"></div>
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-3xl h-px bg-gradient-to-r from-transparent via-brand-orange/30 to-transparent"></div>
    <div class="relative z-10 max-w-4xl mx-auto text-center">
      <div class="inline-flex items-center gap-2 bg-brand-orange/12 border border-brand-orange/30 text-brand-orange px-4 py-2 rounded-full text-sm font-medium mb-8" data-aos="fade-down">
        <span class="w-2 h-2 bg-brand-orange rounded-full animate-pulse"></span>
        Consulta gratuita disponível agora
      </div>
      <h2 class="font-display font-bold text-4xl sm:text-5xl lg:text-6xl mb-6" data-aos="fade-up">
        Pronto para realizar<br><span class="text-grad">o sonho do seu veículo?</span>
      </h2>
      <p class="text-white/60 text-lg sm:text-xl max-w-2xl mx-auto mb-10 leading-relaxed" data-aos="fade-up" data-aos-delay="100">
        Fale agora com João Vitor. Simulação gratuita, sem compromisso. Ele mostra o plano ideal para você ser contemplado o quanto antes.
      </p>
      <div data-aos="fade-up" data-aos-delay="200">
        <a href="https://wa.me/5528999693542?text=Ol%C3%A1%20Jo%C3%A3o%20Vitor!%20Quero%20uma%20simula%C3%A7%C3%A3o%20gratuita%20de%20cons%C3%B3rcio%20de%20ve%C3%ADculos."
           class="inline-flex items-center gap-3 bg-[#25D366] hover:bg-[#20bb5a] text-white px-10 py-5 rounded-full text-xl font-bold transition-all hover:scale-105 shadow-[0_8px_40px_rgba(37,211,102,.35)] wa-pulse">
          <i class="fab fa-whatsapp text-2xl"></i>
          Falar com João agora
        </a>
      </div>
      <div class="flex flex-wrap items-center justify-center gap-8 mt-14" data-aos="fade-up" data-aos-delay="300">
        <div class="flex flex-col items-center gap-1"><i class="fas fa-lock text-white/25 text-lg"></i><span class="text-white/35 text-xs">100% Seguro</span></div>
        <div class="flex flex-col items-center gap-1"><i class="fas fa-clock text-white/25 text-lg"></i><span class="text-white/35 text-xs">Resposta rápida</span></div>
        <div class="flex flex-col items-center gap-1"><i class="fas fa-ban text-white/25 text-lg"></i><span class="text-white/35 text-xs">Sem spam</span></div>
        <div class="flex flex-col items-center gap-1"><i class="fas fa-handshake text-white/25 text-lg"></i><span class="text-white/35 text-xs">Sem compromisso</span></div>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="bg-[#070811] border-t border-white/5 py-12 px-6">
    <div class="max-w-7xl mx-auto">
      <div class="flex flex-col md:flex-row items-center justify-between gap-10">
        <div class="flex flex-col items-center md:items-start gap-4">
          <img src="<?php echo get_template_directory_uri(); ?>/logo sf branca.png" alt="João do Consórcio" class="h-10">
          <p class="text-white/30 text-sm text-center md:text-left max-w-xs leading-relaxed">
            Especialista em consórcio de veículos. Realizando sonhos sem juros.
          </p>
        </div>
        <div class="flex flex-col items-center gap-3 text-sm">
          <a href="#como-funciona" class="text-white/35 hover:text-white transition-colors">Como Funciona</a>
          <a href="#veiculos"      class="text-white/35 hover:text-white transition-colors">Veículos</a>
          <a href="#comparativo"  class="text-white/35 hover:text-white transition-colors">Comparativo</a>
          <a href="#depoimentos"  class="text-white/35 hover:text-white transition-colors">Depoimentos</a>
          <a href="#faq"          class="text-white/35 hover:text-white transition-colors">Perguntas Frequentes</a>
        </div>
        <div class="flex flex-col items-center md:items-end gap-4">
          <a href="https://wa.me/5528999693542"
             class="flex items-center gap-2 bg-[#25D366] text-white px-6 py-3 rounded-full font-semibold text-sm hover:scale-105 transition-transform">
            <i class="fab fa-whatsapp text-lg"></i> WhatsApp
          </a>
          <p class="text-white/20 text-xs">Regulamentado pelo Banco Central do Brasil</p>
        </div>
      </div>
      <div class="border-t border-white/5 mt-10 pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-white/20">
        <p>© 2026 João do Consórcio. Todos os direitos reservados.</p>
        <p>Feito para realizar sonhos <span class="text-brand-orange">♥</span></p>
      </div>
    </div>
  </footer>

  <?php wp_footer(); ?>
  <script>
    AOS.init({ duration: 750, once: true, offset: 80, easing: 'ease-out-cubic' });

    function toggleFaq(btn) {
      const item = btn.closest('.faq-item');
      const body = item.querySelector('.faq-body');
      const icon = item.querySelector('.faq-icon');
      const isOpen = body.classList.contains('open');
      document.querySelectorAll('.faq-item').forEach(i => {
        i.querySelector('.faq-body').classList.remove('open');
        i.querySelector('.faq-icon').style.transform = 'rotate(0deg)';
      });
      if (!isOpen) { body.classList.add('open'); icon.style.transform = 'rotate(45deg)'; }
    }

    const scrollBar = document.getElementById('scroll-bar');
    window.addEventListener('scroll', () => {
      const pct = window.scrollY / (document.body.scrollHeight - window.innerHeight) * 100;
      scrollBar.style.width = pct + '%';
    }, { passive: true });

    const heroImg = document.getElementById('hero-img');
    window.addEventListener('scroll', () => {
      if (window.scrollY < window.innerHeight * 1.2)
        heroImg.style.transform = `translateY(${window.scrollY * 0.28}px)`;
    }, { passive: true });

    (function () {
      const canvas = document.getElementById('hero-canvas');
      const ctx = canvas.getContext('2d');
      let W, H, particles = [];
      function resize() { W = canvas.width = canvas.parentElement.offsetWidth; H = canvas.height = canvas.parentElement.offsetHeight; }
      resize();
      window.addEventListener('resize', resize, { passive: true });
      for (let i = 0; i < 55; i++) {
        particles.push({ x: Math.random()*(W||1920), y: Math.random()*(H||900), r: Math.random()*1.6+0.4, vx: (Math.random()-.5)*.35, vy: (Math.random()-.5)*.35, a: Math.random()*.5+.1 });
      }
      function draw() {
        ctx.clearRect(0,0,W,H);
        particles.forEach(p => {
          ctx.beginPath(); ctx.arc(p.x,p.y,p.r,0,Math.PI*2);
          ctx.fillStyle=`rgba(212,104,42,${p.a})`; ctx.fill();
          p.x+=p.vx; p.y+=p.vy;
          if(p.x<0)p.x=W; if(p.x>W)p.x=0; if(p.y<0)p.y=H; if(p.y>H)p.y=0;
        });
        requestAnimationFrame(draw);
      }
      draw();
    })();

    function animateCounter(el) {
      const target = +el.dataset.target, suffix = el.dataset.suffix||'', duration = 1800, start = performance.now();
      function step(now) {
        const elapsed = now-start, progress = Math.min(elapsed/duration,1), ease = 1-Math.pow(1-progress,3);
        el.textContent = Math.floor(ease*target)+suffix;
        if(progress<1) requestAnimationFrame(step);
      }
      requestAnimationFrame(step);
    }
    const counterObserver = new IntersectionObserver((entries) => {
      entries.forEach(e => { if(e.isIntersecting){ animateCounter(e.target); counterObserver.unobserve(e.target); } });
    }, { threshold: 0.5 });
    document.querySelectorAll('.stat-num').forEach(el => counterObserver.observe(el));

    document.querySelectorAll('.tilt-wrap').forEach(card => {
      card.addEventListener('mousemove', e => {
        const rect = card.getBoundingClientRect();
        const x = (e.clientX-rect.left)/rect.width-.5, y = (e.clientY-rect.top)/rect.height-.5;
        card.style.transform = `perspective(700px) rotateY(${x*10}deg) rotateX(${-y*10}deg) translateY(-5px)`;
      });
      card.addEventListener('mouseleave', () => { card.style.transform = ''; });
    });

    document.querySelectorAll('a, button').forEach(btn => {
      btn.classList.add('ripple-btn');
      btn.addEventListener('click', function(e) {
        const rect = this.getBoundingClientRect(), size = Math.max(rect.width,rect.height);
        const wave = document.createElement('span');
        wave.className = 'ripple-wave';
        wave.style.cssText = `width:${size}px;height:${size}px;left:${e.clientX-rect.left-size/2}px;top:${e.clientY-rect.top-size/2}px;`;
        this.appendChild(wave); setTimeout(()=>wave.remove(),600);
      });
    });

    document.getElementById('navbar').addEventListener('scroll', () => {}, { passive: true });
    window.addEventListener('scroll', () => {
      document.getElementById('navbar').classList.toggle('scrolled', window.scrollY > 60);
    }, { passive: true });

    document.getElementById('intro-overlay').addEventListener('animationend', function(){ this.style.display='none'; });

    // ── SIMULADOR INTERATIVO ──────────────────────────────────────────────────
    (function () {
      var SIM = {
        tipo:  'veiculo',
        valor: 100000,
        prazo: 48,
        valores: {
          veiculo: [80000, 100000, 150000, 200000, 300000, 350000, 400000],
          imovel:  [200000, 300000, 600000, 1000000]
        },
        prazos: {
          veiculo: [24, 36, 48, 60, 84],
          imovel:  [120, 240, 420]
        }
      };

      // Valores reais dos planos de consórcio
      var CON = {
        veiculo: {
          80000:   { antes:  1023.91, apos:  1261.99 },
          100000:  { antes:  1178.08, apos:  1475.70 },
          150000:  { antes:  1767.12, apos:  2213.55 },
          200000:  { antes:  1977.00, apos:  2490.00 },
          300000:  { antes:  2965.00, apos:  3735.00 },
          350000:  { antes:  3459.17, apos:  4357.50 }, // estimado proporcional
          400000:  { antes:  3953.33, apos:  4980.00 }  // estimado proporcional
        },
        imovel: {
          200000:  { parcela: 1308.00 },
          300000:  { parcela: 1963.00 },
          600000:  { parcela: 3926.00 },
          1000000: { parcela: 6544.00 }
        }
      };

      function fmt(v) {
        return v.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL', maximumFractionDigits: 0 });
      }
      function fmt2(v) {
        return v.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL', minimumFractionDigits: 2, maximumFractionDigits: 2 });
      }
      function fmtLabel(v) {
        if (v >= 1000000) return 'R$ 1 mi';
        return 'R$ ' + (v / 1000).toLocaleString('pt-BR', { maximumFractionDigits: 0 }) + ' mil';
      }
      function pmt(pv, r, n) {
        var f = Math.pow(1 + r, n);
        return pv * r * f / (f - 1);
      }

      function stiloTipo(el, on) {
        el.style.background   = on ? '#D4682A' : 'transparent';
        el.style.color        = on ? '#fff' : 'rgba(255,255,255,0.55)';
        el.style.borderColor  = on ? '#D4682A' : 'rgba(255,255,255,0.18)';
      }
      function stiloVal(el, on) {
        el.style.background  = on ? '#D4682A' : 'transparent';
        el.style.color       = on ? '#fff' : 'rgba(255,255,255,0.55)';
        el.style.borderColor = on ? '#D4682A' : 'rgba(255,255,255,0.15)';
      }
      function stiloPrazo(el, on) {
        var only = el.dataset.only === '1';
        el.style.background = on ? '#D4682A' : 'transparent';
        el.style.color      = on ? '#fff' : (only ? 'rgba(212,104,42,0.95)' : 'rgba(255,255,255,0.45)');
      }

      function renderValores() {
        var c = document.getElementById('sim-valores');
        if (!c) return;
        c.innerHTML = '';
        SIM.valores[SIM.tipo].forEach(function (v) {
          var btn = document.createElement('button');
          btn.type = 'button';
          btn.className = 'px-5 py-2.5 rounded-full text-sm font-semibold border-2 transition-all duration-200 cursor-pointer';
          btn.dataset.simVal = v;
          stiloVal(btn, v === SIM.valor);
          btn.textContent = fmtLabel(v);
          btn.addEventListener('click', function () { window.simSetValor(v); });
          c.appendChild(btn);
        });
      }

      function renderPrazos() {
        var c = document.getElementById('sim-prazos');
        if (!c) return;
        c.innerHTML = '';
        SIM.prazos[SIM.tipo].forEach(function (p) {
          var btn = document.createElement('button');
          btn.type = 'button';
          btn.id = 'sim-prazo-' + p;
          btn.className = 'px-6 py-2.5 rounded-full text-sm font-semibold transition-all duration-200';
          if (p === 84) {
            btn.dataset.only = '1';
            btn.innerHTML = '84 meses <span style="font-size:9px;font-weight:700;letter-spacing:.04em;text-transform:uppercase;opacity:.85;margin-left:3px">só consórcio</span>';
          } else {
            btn.textContent = p + ' meses';
          }
          btn.addEventListener('click', function () { window.simSetPrazo(p); });
          stiloPrazo(btn, p === SIM.prazo);
          c.appendChild(btn);
        });
      }

      function renderResult() {
        var isImovel = SIM.tipo === 'imovel';
        var r        = isImovel ? 0.0095 : 0.03;
        var conMult  = isImovel ? 1.27   : 1.16;
        var parFin   = pmt(SIM.valor, r, SIM.prazo);
        var totFin   = parFin * SIM.prazo;
        var jurFin   = totFin - SIM.valor;
        var totCon   = SIM.valor * conMult;
        var econ     = totFin - totCon;

        function set(id, txt) { var el = document.getElementById(id); if (el) el.textContent = txt; }

        var fin84 = (SIM.tipo === 'veiculo' && SIM.prazo === 84);

        if (fin84) {
          set('sim-fin-parcela',    'Indisponível');
          set('sim-fin-juros',      '—');
          set('sim-fin-total',      '—');
          set('sim-economia-label', 'O banco não financia em 84x');
          set('sim-economia-val',   'Só no consórcio');
        } else {
          set('sim-fin-parcela',    fmt2(parFin));
          set('sim-fin-juros',      fmt(jurFin));
          set('sim-fin-total',      fmt(totFin));
          set('sim-economia-label', 'Com o consórcio, você economiza');
          set('sim-economia-val',   fmt(econ));
        }
        set('sim-con-total',      fmt(totCon));
        set('sim-fin-taxa-label', fin84 ? '—' : (isImovel ? '0,95% ao mês' : '3% ao mês'));
        set('sim-con-taxa-label', isImovel ? '27% total'    : '16% total');
        set('sim-footnote',       isImovel
          ? '*Taxa de referência: 0,95% a.m. (financiamento). Taxa administrativa do consórcio: 27% total. Valores aproximados para fins ilustrativos.'
          : '*Taxa de referência: 3% a.m. (financiamento). Taxa administrativa do consórcio: 16% total. Valores aproximados para fins ilustrativos.');

        var hintEl = document.getElementById('sim-prazo-hint');
        if (hintEl) {
          hintEl.innerHTML = isImovel
            ? 'O consórcio de imóvel pode ser dividido em até <span class="text-brand-orange font-semibold">204x</span> — escolha o prazo do financiamento para comparar.'
            : 'O consórcio é sempre dividido em até <span class="text-brand-orange font-semibold">84x</span> — escolha o prazo do financiamento para comparar.';
        }

        var rowApos = document.getElementById('sim-con-row-apos');

        if (SIM.tipo === 'veiculo') {
          var d = CON.veiculo[SIM.valor] || {};
          set('sim-con-antes-label',  'Parcela em 84x');
          set('sim-con-antes',        fmt2(d.antes || 0));
          set('sim-con-parcela',      fmt2(d.apos  || 0));
          if (rowApos) rowApos.style.display = '';
          set('sim-con-prazo-label',  'Em até 84x');
          set('sim-con-prazo-header', 'Parcelado em até 84x');
        } else {
          var d2 = CON.imovel[SIM.valor] || {};
          set('sim-con-antes-label',  'Parcela mensal');
          set('sim-con-antes',        fmt2(d2.parcela || 0));
          if (rowApos) rowApos.style.display = 'none';
          set('sim-con-prazo-label',  'Em até 204x');
          set('sim-con-prazo-header', 'Parcelado em até 204x');
        }
      }

      window.simSetTipo = function (t) {
        SIM.tipo = t;
        if (SIM.valores[t].indexOf(SIM.valor) === -1) SIM.valor = SIM.valores[t][1] || SIM.valores[t][0];
        SIM.prazo = SIM.prazos[t][0];
        ['veiculo','imovel'].forEach(function (id) {
          var el = document.getElementById('sim-btn-' + id);
          if (el) stiloTipo(el, id === t);
        });
        renderValores();
        renderPrazos();
        renderResult();
      };

      window.simSetValor = function (v) {
        SIM.valor = v;
        document.querySelectorAll('#sim-valores button').forEach(function (btn) {
          stiloVal(btn, +btn.dataset.simVal === v);
        });
        renderResult();
      };

      window.simSetPrazo = function (n) {
        SIM.prazo = n;
        SIM.prazos[SIM.tipo].forEach(function (p) {
          var el = document.getElementById('sim-prazo-' + p);
          if (el) stiloPrazo(el, p === n);
        });
        renderResult();
      };

      function init() {
        ['veiculo','imovel'].forEach(function (id) {
          var el = document.getElementById('sim-btn-' + id);
          if (el) stiloTipo(el, id === SIM.tipo);
        });
        renderValores();
        renderPrazos();
        renderResult();
      }

      if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
      } else {
        init();
      }
    })();
  </script>
</body>
</html>
