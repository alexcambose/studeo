import config from './config';
import color from 'color';

export const MATERII = [
    {
        name: 'Matematică',
        slug: 'mate',
    },
    {
        name: 'Informatica',
        slug: 'info',
    },
    {
        name: 'Romana',
        slug: 'ro',
    },
    {
        name: 'Biologie',
        slug: 'bio',
    },
    {
        name: 'Fizica',
        slug: 'fiz',
    },
    {
        name: 'Chimie',
        slug: 'chim',
    },
    {
        name: 'Geografie',
        slug: 'geogra',
    },
    {
        name: 'Limbi straine',
        slug: 'lbs',
    },
];

export const cities = ['Abrud', 'Adjud', 'Agnita', 'Aiud', 'Alba Iulia', 'Aleșd', 'Alexandria', 'Amara', 'Anina', 'Aninoasa', 'Arad', 'Ardud', 'Avrig', 'Azuga', 'Babadag', 'Băbeni', 'Bacău', 'Baia de Aramă',
    'Baia de Arieș', 'Baia Mare', 'Baia Sprie', 'Băicoi', 'Băile Govora', 'Băile Herculane', 'Băile Olănești', 'Băile Tușnad', 'Băilești', 'Bălan', 'Bălcești', 'Balș', 'Băneasa', 'Baraolt',
    'Bârlad', 'Bechet', 'Beclean', 'Beiuș', 'Berbești', 'Berești', 'Bicaz', 'Bistrița', 'Blaj', 'Bocșa', 'Boldești-Scăeni', 'Bolintin-Vale', 'Borșa', 'Borsec', 'Botoșani', 'Brad', 'Bragadiru',
    'Brăila', 'Brașov', 'Breaza', 'Brezoi', 'Broșteni', 'Bucecea', 'București', 'Budești', 'Buftea', 'Buhuși', 'Bumbești-Jiu', 'Bușteni', 'Buzău', 'Buziaș', 'Cajvana', 'Calafat', 'Călan',
    'Călărași', 'Călimănești', 'Câmpeni', 'Câmpia Turzii', 'Câmpina', 'Câmpulung Moldovenesc', 'Câmpulung', 'Caracal', 'Caransebeș', 'Carei', 'Cavnic', 'Căzănești', 'Cehu Silvaniei',
    'Cernavodă', 'Chișineu-Criș', 'Chitila', 'Ciacova', 'Cisnădie', 'Cluj-Napoca', 'Codlea', 'Comănești', 'Comarnic', 'Constanța', 'Copșa Mică', 'Corabia', 'Costești', 'Covasna', 'Craiova',
    'Cristuru Secuiesc', 'Cugir', 'Curtea de Argeș', 'Curtici', 'Dăbuleni', 'Darabani', 'Dărmănești', 'Dej', 'Deta', 'Deva', 'Dolhasca', 'Dorohoi', 'Drăgănești-Olt', 'Drăgășani', 'Dragomirești',
    'Drobeta-Turnu Severin', 'Dumbrăveni', 'Eforie', 'Făgăraș', 'Făget', 'Fălticeni', 'Făurei', 'Fetești', 'Fieni', 'Fierbinți-Târg', 'Filiași', 'Flămânzi', 'Focșani', 'Frasin', 'Fundulea',
    'Găești', 'Galați', 'Gătaia', 'Geoagiu', 'Gheorgheni', 'Gherla', 'Ghimbav', 'Giurgiu', 'Gura Humorului', 'Hârlău', 'Hârșova', 'Hațeg', 'Horezu', 'Huedin', 'Hunedoara', 'Huși', 'Ianca',
    'Iași', 'Iernut', 'Ineu', 'Însurăței', 'Întorsura Buzăului', 'Isaccea', 'Jibou', 'Jimbolia', 'Lehliu Gară', 'Lipova', 'Liteni', 'Livada', 'Luduș', 'Lugoj', 'Lupeni', 'Măcin', 'Măgurele',
    'Mangalia', 'Mărășești', 'Marghita', 'Medgidia', 'Mediaș', 'Miercurea Ciuc', 'Miercurea Nirajului', 'Miercurea Sibiului', 'Mihăilești', 'Milișăuți', 'Mioveni', 'Mizil', 'Moinești',
    'Moldova Nouă', 'Moreni', 'Motru', 'Murfatlar', 'Murgeni', 'Nădlac', 'Năsăud', 'Năvodari', 'Negrești', 'Negrești-Oaș', 'Negru Vodă', 'Nehoiu', 'Novaci', 'Nucet', 'Ocna Mureș',
    'Ocna Sibiului', 'Ocnele Mari', 'Odobești', 'Odorheiu Secuiesc', 'Oltenița', 'Onești', 'Oradea', 'Orăștie', 'Oravița', 'Orșova', 'Oțelu Roșu', 'Otopeni', 'Ovidiu', 'Panciu', 'Pâncota',
    'Pantelimon', 'Pașcani', 'Pătârlagele', 'Pecica', 'Petrila', 'Petroșani', 'Piatra Neamț', 'Piatra-Olt', 'Pitești', 'Ploiești', 'Plopeni', 'Podu Iloaiei', 'Pogoanele', 'Popești-Leordeni',
    'Potcoava', 'Predeal', 'Pucioasa', 'Răcari', 'Rădăuți', 'Râmnicu Sărat', 'Râșnov', 'Recaș', 'Reghin', 'Reșița', 'Roman', 'Roșiorii de Vede', 'Rovinari', 'Roznov', 'Rupea', 'Săcele',
    'Săcueni', 'Salcea', 'Săliște', 'Săliștea de Sus', 'Salonta', 'Sângeorgiu de Pădure', 'Sângeorz-Băi', 'Sânnicolau Mare', 'Sântana', 'Sărmașu', 'Satu Mare', 'Săveni', 'Scornicești',
    'Sebeș', 'Sebiș', 'Segarcea', 'Seini', 'Sfântu Gheorghe', 'Sibiu', 'Sighetu Marmației', 'Sighișoara', 'Simeria', 'Șimleu Silvaniei', 'Sinaia', 'Siret', 'Slănic', 'Slănic-Moldova',
    'Slatina', 'Slobozia', 'Solca', 'Șomcuta Mare', 'Sovata', 'Ștefănești, Argeș', 'Ștefănești, Botoșani', 'Ștei', 'Strehaia', 'Suceava', 'Sulina', 'Tălmaciu', 'Țăndărei', 'Târgoviște',
    'Târgu Bujor', 'Târgu Cărbunești', 'Târgu Frumos', 'Târgu Jiu', 'Târgu Lăpuș', 'Târgu Mureș', 'Târgu Neamț', 'Târgu Ocna', 'Târgu Secuiesc', 'Târnăveni', 'Tășnad', 'Tăuții-Măgherăuș',
    'Techirghiol', 'Tecuci', 'Teiuș', 'Țicleni', 'Timișoara', 'Tismana', 'Titu', 'Toplița', 'Topoloveni', 'Tulcea', 'Turceni', 'Turda', 'Turnu Măgurele','Ulmeni', 'Ungheni', 'Uricani',
    'Urlați', 'Urziceni', 'Valea lui Mihai', 'Vălenii de Munte', 'Vânju Mare', 'Vașcău', 'Vaslui', 'Vatra Dornei', 'Vicovu de Sus', 'Victoria', 'Videle', 'Vișeu de Sus', 'Vlăhița', 'Voluntari',
    'Vulcan', 'Zalău', 'Zărnești', 'Zimnicea', 'Zlatna',
];

export const convertFileSizeToHuman = size => {
    if (size >= 1000000000) return '1 GB';
    // megabytes
    if (size >= 1000000) return (size/1000000).toFixed(1).replace(/[.,]0$/, '') + ' MB';
    // kilobytes
    if (size >= 1000) return (size/1000).toFixed(1).replace(/[.,]0$/, '') + ' KB';
};

export const chunkArray = (array, length) => {
    if (length) {
        let newArr = [];
        let temp = [];

        for (let i = 0; i < array.length; i++){
            temp.push(array[i]);
            if ((i+1)%length === 0){
                newArr.push(temp);
                temp = [];
            }
        }
        if (temp.length) newArr.push(temp);
        return newArr;
    } else {
        for (let i = 2;i < array.length - 1;i++) {
            if (array.length%i === 0) return chunkArray(array, i);
        }
        return chunkArray(array, 1);
    }
};

export const monthNames = ['Ianuarie', 'Februarie', 'Martie', 'Aprilie', 'Mai', 'Iunie', 'Iulie', 'August', 'Septembrie', 'Octombrie', 'Noiembrie', 'Decembrie'];
export const displayDate = e => {
    let date = new Date(e);
    return date.getDate() + ' ' + monthNames[date.getMonth()] + ' ' + date.getFullYear();
};

export const pluralize = (number, singular, plural) => {
    let content = '';
    if (number < 1) content += 'nicio ' + singular;
    if (number === 1) content += 'o ' + singular;
    if (number > 1) content += number + (number > 19 ? ' de ' : ' ') + plural;
    return content;
};

export const timeConvert = (sec, levelIndex = 0) => {
    const levels = [['secundă', 'secunde'], ['minut', 'minute'], ['oră', 'ore'], ['zi', 'zile'], ['lună', 'luni'], ['an', 'ani']];
    if (sec > 60) return timeConvert(Math.floor(sec / 60), levelIndex + 1);
    return sec + (sec % 100 > 19 ? ' de ' : ' ') + levels[levelIndex][sec === 1 ? 0 : 1]; // in functie de cum o sa fie mai ok formatarea, modificam
};

export const percent = (current, max, rounded = true) => {
    if (rounded) return Math.floor(current/max * 100);
    return current/max * 100;
};
/* ca sa nu mai calculăm
lvl 1: < 100xp (100xp)
lvl 2: < 210xp (110xp)
lvl 3: < 331xp (121xp)
lvl 4: < 464xp (133xp)
lvl 5: < 610xp (146xp)
lvl 6: < 771xp (161xp)
 */
export const xp = level => { // cat xp are un level
    if(level === 0) return 0;
    return xp(level - 1) + Math.floor(100 * (1.1 ** (level - 1)));
};

export const level = theXp => { // ce level are in functie de xp, nu merge frumos recursiv :c
    let level = 0;
    while(xp(level) <= theXp) level++;
    return level;
};
export const levelColor = level => {
    const colorIndex = Object.keys(config.xpLevelColors).find(e => e >= level);
    return color(config.xpLevelColors[colorIndex]).darken(level%10 / 10 / 2);
};