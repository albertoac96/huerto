<div class="secFuerte">
    <h2>
        <label class="titulo">PALETA VEGETAL</label>
    </h2>

    <div class="container text-center">
    <div class="search-container">
    <input type="text" id="searchInput" class="form-control" placeholder="Buscar plantas..." onkeyup="filterCards()">
</div>

        <div class="row row-cols-1 row-cols-sm-1 row-cols-md-3 row-cols-lg-4">

        @foreach ($plantas as $planta)
            <div class="col mt-3 planta-card" data-name="{{ strtolower($planta->cNombre) }}">
                <div class="card bg-transparent" style="border:0;">
                    <div class="img-container">
                        <img src="{{asset('images/content/catalogo').'/'.$planta->idPlanta.'.webp'}}" style="border:0;border-top-left-radius:3em;border-bottom-right-radius:3em;object-fit: cover;">
                    </div>
                    <div class="card-img-overlay">
                        <button class="botonPequeno position-absolute bottom-0 end-0" type="button"
                            onclick="window.location='{{ url('/planta/' . $planta->idPlanta) }}'">¡Conoce más!
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <label class="texttitle mt-3">{{$planta->cNombre}}</label><br>
                </div>
            </div>
        @endforeach  




        </div>
    </div>

</div>



<script>
    function filterCards() {
        var input = document.getElementById('searchInput');
        var filter = input.value.toLowerCase();
        var cards = document.getElementsByClassName('planta-card');

        for (var i = 0; i < cards.length; i++) {
             var name = normalizeText(cards[i].getAttribute('data-name'));
                console.log(name);
            if (name.indexOf(filter) > -1) {
                cards[i].style.display = "";
            } else {
                cards[i].style.display = "none";
            }
        }
    }

    function normalizeText(text) {
        return text.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
     
    }
</script>
