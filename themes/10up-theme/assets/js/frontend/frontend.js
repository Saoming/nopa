import '../../css/frontend/style.css';
import Header from './components/header';
import Newsletter from './components/newsletter';
import SplideCarousel from './components/splidecarousel';
import CardSectionStacked from './blocks/card-section-stacked';
import Wavy from './blocks/wavy';
// import './woocommerce/cross-sell';
import './woocommerce/ajax-add-to-cart';
import './woocommerce/personalize-product';
import './woocommerce/mini-cart';

// Class Components
const header = new Header();
header.init();

const newsletter = new Newsletter();
newsletter.init();

const splideCarousel = new SplideCarousel();
splideCarousel.init();

// Blocks Components
CardSectionStacked();
Wavy();
