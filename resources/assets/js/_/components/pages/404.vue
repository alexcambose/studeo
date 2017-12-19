<template>
    <div class="container forofor">
        <div class="title">Eroare <strong>404</strong> :(</div>
        <div class="subtitle">Pagina căutată nu există</div>

        <blockquote>
            <em>{{quotes[randomQuoteIndex].content}}</em> - <strong>{{quotes[randomQuoteIndex].author}}</strong>
        </blockquote>
    </div>
</template>
<script>
    // chestie random cu citate
    const quotes = [
        {
            author: 'Thomas Jefferson',
            content: 'E mai bine să nu ai idei deloc, decât să ai idei proaste. Mai bine să nu crezi în nimic, decât să crezi în ceva greşit.',
        },
        {
            author: ' Marin Preda',
            content: 'O furnică nu poate răsturna un munte, dar îl poate muta din loc încet, bucăţică cu bucăţică.',
        },
        {
            author: 'Dalai Lama',
            content: 'Când pierzi, ai grijă să nu pierzi lecția.',
        },
        {
            author: 'Dalai Lama',
            content: 'Dăruiește-i persoanei pe care o iubești: aripi pentru a zbura, rădăcini pentru a se întoarce și motive pentru a rămâne.',
        },
        {
            author: 'Dalai Lama',
            content: 'Învață regulile astfel încât să știi cum să le încalci cum se cuvine.',
        },
        {
            author: 'Dalai Lama',
            content: 'Nu am nevoie de o religie pentru a crede. Bunătatea este religia mea.',
        },
        {
            author: 'Edgar Allan Poe',
            content: 'Dacă nu ai suferit niciodată, înseamnă ca nu ești binecuvântat.',
        },
        {
            author: 'François Rabelais',
            content: 'Un om deştept poate să înveţe şi de la un prost. Invers e mai greu.',
        },
        {
            author: 'Plutarh',
            content: 'În oamenii frumoşi e frumoasă şi toamna.',
        },
        {
            author: 'Friedrich Nietzsche',
            content: 'Uitarea şi mersul mai departe sunt cea mai mare înţelepciune.',
        },
        {
            author: 'Helen Keller',
            content: 'Cele mai bune şi mai frumoase lucruri din lume nu pot fi văzute sau atinse. Ele trebuie simţite în inimă.',
        },

        // ...more
    ];
    export default {
        mounted() {
            this.randomQuoteIndex = Math.floor(Math.random() * this.quotes.length);
        },
        data() {
            return {
                quotes,
                randomQuoteIndex: 0,
            };
        },
    };
</script>
<style>
    .forofor{
        margin-top: 40px;
        text-align: center;
    }
    .forofor .title{
        font-size: 4em;
        font-weight: 300;
    }
    .forofor .subtitle{
        margin-bottom: 40px;
    }
</style>