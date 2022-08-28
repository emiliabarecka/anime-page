<div class="row">
  <div class="col my-3">
    <?php if (!empty($_SESSION['userType']) && $_SESSION['userType'] === 'owner') : ?>
      <a href="/?action=create"><button class="btn btn-secondary">Dodaj nową anime</button></a>
    <?php endif; ?>
  </div>
</div>
<div class="row">
  <div class="col">
    <h1 class="text-center mb-5 h2">Najlepsze anime na początek</h1>
    <p class="h6">Wybór pierwszej anime do zapoznania się z gatunkiem nie jest prosty. Ilość dostępnych tytułów jest ogromna, istnieje wiele rodzajów przeznaczonych dla konkretnego rodzaju widzów. Stąd przez przypadek można trafić na produkcję niezrozumiałą, albo skierowaną do bardziej doświadczonych anime-fanów. Wtedy łatwo odbić sie od gatunku i więcej do niego nie wracać. A na to nie możemy pozwolic ;) Dlatego chcę pokazać kilka odpowiednich w sam raz na pierwsze seanse.</p>
  </div>
</div>