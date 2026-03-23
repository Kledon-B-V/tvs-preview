<?php get_header(); ?>

<section style="
  min-height:100vh;
  display:flex;
  align-items:center;
  justify-content:center;
  background:var(--gray-900);
  position:relative;
  overflow:hidden;
">
  <!-- Decorative orbs -->
  <div style="position:absolute;top:20%;left:-100px;width:400px;height:400px;border-radius:50%;background:rgba(227,30,36,.12);filter:blur(100px);pointer-events:none"></div>
  <div style="position:absolute;bottom:15%;right:-80px;width:350px;height:350px;border-radius:50%;background:rgba(59,130,246,.08);filter:blur(100px);pointer-events:none"></div>

  <div class="container" style="position:relative;z-index:2;text-align:center;padding:var(--space-20) 0">
    <!-- Glass card -->
    <div style="
      display:inline-block;
      max-width:560px;
      width:100%;
      background:rgba(255,255,255,.05);
      backdrop-filter:blur(20px);
      -webkit-backdrop-filter:blur(20px);
      border:1px solid rgba(255,255,255,.1);
      border-radius:var(--radius-2xl);
      padding:var(--space-16) var(--space-10);
      box-shadow:0 20px 60px rgba(0,0,0,.3);
    ">
      <!-- Error code -->
      <span style="
        display:inline-block;
        font-size:var(--text-6xl);
        font-weight:800;
        background:linear-gradient(135deg,var(--red-500),var(--orange-500));
        -webkit-background-clip:text;
        -webkit-text-fill-color:transparent;
        background-clip:text;
        line-height:1;
        margin-bottom:var(--space-4);
      ">404</span>

      <h1 style="
        color:#fff;
        font-size:var(--text-3xl);
        margin-bottom:var(--space-4);
        font-weight:700;
      ">Pagina niet gevonden</h1>

      <p style="
        color:rgba(255,255,255,.6);
        font-size:var(--text-lg);
        line-height:1.7;
        max-width:420px;
        margin:0 auto var(--space-10);
      ">De pagina die u zoekt bestaat niet of is verplaatst. Controleer de URL of ga terug naar de homepagina.</p>

      <!-- Red accent button -->
      <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary btn-lg" style="
        background:linear-gradient(135deg,var(--red-500),#ff3333);
        padding:14px 36px;
        font-size:var(--text-base);
        font-weight:600;
        border-radius:var(--radius-md);
        box-shadow:0 8px 32px rgba(227,30,36,.35);
        transition:all var(--duration) var(--ease);
      ">
        <span>&larr;</span> Terug naar Home
      </a>

      <!-- Subtle separator + secondary link -->
      <div style="margin-top:var(--space-8);padding-top:var(--space-6);border-top:1px solid rgba(255,255,255,.08)">
        <a href="<?php echo esc_url(home_url('/contact')); ?>" style="
          color:rgba(255,255,255,.45);
          font-size:var(--text-sm);
          transition:color var(--duration) var(--ease);
          text-decoration:none;
        " onmouseover="this.style.color='var(--red-500)'" onmouseout="this.style.color='rgba(255,255,255,.45)'">
          Hulp nodig? Neem contact op
        </a>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>
