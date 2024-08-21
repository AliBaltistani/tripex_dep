<style>
    .intl-tel-input {
        position: relative;
        display: inline-block;
    }

    .intl-tel-input * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }

    .intl-tel-input .hide {
        display: none;
    }

    .intl-tel-input .v-hide {
        visibility: hidden;
    }

    .intl-tel-input input,
    .intl-tel-input input[type=text],
    .intl-tel-input input[type=tel] {
        position: relative;
        z-index: 0;
        margin-top: 0 !important;
        margin-bottom: 0 !important;
        padding-right: 36px;
        margin-right: 0;
    }

    .intl-tel-input .flag-container {
        position: absolute;
        top: 0;
        bottom: 0;
        right: 0;
        padding: 1px;
    }

    .intl-tel-input .selected-flag {
        z-index: 1;
        position: relative;
        width: 36px;
        height: 100%;
        padding: 0 0 0 8px;
    }

    .intl-tel-input .selected-flag .iti-flag {
        position: absolute;
        top: 0;
        bottom: 0;
        margin: auto;
    }

    .intl-tel-input .selected-flag .iti-arrow {
        position: absolute;
        top: 50%;
        margin-top: -2px;
        right: 6px;
        width: 0;
        height: 0;
        border-left: 3px solid transparent;
        border-right: 3px solid transparent;
        border-top: 4px solid #555;
    }

    .intl-tel-input .selected-flag .iti-arrow.up {
        border-top: none;
        border-bottom: 4px solid #555;
    }

    .intl-tel-input .country-list {
        position: absolute;
        z-index: 2;
        list-style: none;
        text-align: left;
        padding: 0;
        margin: 0 0 0 -1px;
        box-shadow: 1px 1px 4px rgba(0, 0, 0, 0.2);
        background-color: white;
        border: 1px solid #CCC;
        white-space: nowrap;
        max-height: 200px;
        overflow-y: scroll;
    }

    .intl-tel-input .country-list.dropup {
        bottom: 100%;
        margin-bottom: -1px;
    }

    .intl-tel-input .country-list .flag-box {
        display: inline-block;
        width: 20px;
    }

    @media (max-width: 500px) {
        .intl-tel-input .country-list {
            white-space: normal;
        }
    }

    .intl-tel-input .country-list .divider {
        padding-bottom: 5px;
        margin-bottom: 5px;
        border-bottom: 1px solid #CCC;
    }

    .intl-tel-input .country-list .country {
        padding: 5px 10px;
    }

    .intl-tel-input .country-list .country .dial-code {
        color: #999;
    }

    .intl-tel-input .country-list .country.highlight {
        background-color: rgba(0, 0, 0, 0.05);
    }

    .intl-tel-input .country-list .flag-box,
    .intl-tel-input .country-list .country-name,
    .intl-tel-input .country-list .dial-code {
        vertical-align: middle;
    }

    .intl-tel-input .country-list .flag-box,
    .intl-tel-input .country-list .country-name {
        margin-right: 6px;
    }

    .intl-tel-input.allow-dropdown input,
    .intl-tel-input.allow-dropdown input[type=text],
    .intl-tel-input.allow-dropdown input[type=tel],
    .intl-tel-input.separate-dial-code input,
    .intl-tel-input.separate-dial-code input[type=text],
    .intl-tel-input.separate-dial-code input[type=tel] {
        padding-right: 6px;
        padding-left: 52px;
        margin-left: 0;
    }

    .intl-tel-input.allow-dropdown .flag-container,
    .intl-tel-input.separate-dial-code .flag-container {
        right: auto;
        left: 0;
    }

    .intl-tel-input.allow-dropdown .selected-flag,
    .intl-tel-input.separate-dial-code .selected-flag {
        width: 46px;
    }

    .intl-tel-input.allow-dropdown .flag-container:hover {
        cursor: pointer;
    }

    .intl-tel-input.allow-dropdown .flag-container:hover .selected-flag {
        background-color: rgba(0, 0, 0, 0.05);
    }

    .intl-tel-input.allow-dropdown input[disabled]+.flag-container:hover,
    .intl-tel-input.allow-dropdown input[readonly]+.flag-container:hover {
        cursor: default;
    }

    .intl-tel-input.allow-dropdown input[disabled]+.flag-container:hover .selected-flag,
    .intl-tel-input.allow-dropdown input[readonly]+.flag-container:hover .selected-flag {
        background-color: transparent;
    }

    .intl-tel-input.separate-dial-code .selected-flag {
        background-color: rgba(0, 0, 0, 0.05);
        display: table;
    }

    .intl-tel-input.separate-dial-code .selected-dial-code {
        display: table-cell;
        vertical-align: middle;
        padding-left: 28px;
    }

    .intl-tel-input.separate-dial-code.iti-sdc-2 input,
    .intl-tel-input.separate-dial-code.iti-sdc-2 input[type=text],
    .intl-tel-input.separate-dial-code.iti-sdc-2 input[type=tel] {
        padding-left: 66px;
    }

    .intl-tel-input.separate-dial-code.iti-sdc-2 .selected-flag {
        width: 60px;
    }

    .intl-tel-input.separate-dial-code.allow-dropdown.iti-sdc-2 input,
    .intl-tel-input.separate-dial-code.allow-dropdown.iti-sdc-2 input[type=text],
    .intl-tel-input.separate-dial-code.allow-dropdown.iti-sdc-2 input[type=tel] {
        padding-left: 76px;
    }

    .intl-tel-input.separate-dial-code.allow-dropdown.iti-sdc-2 .selected-flag {
        width: 70px;
    }

    .intl-tel-input.separate-dial-code.iti-sdc-3 input,
    .intl-tel-input.separate-dial-code.iti-sdc-3 input[type=text],
    .intl-tel-input.separate-dial-code.iti-sdc-3 input[type=tel] {
        padding-left: 74px;
    }

    .intl-tel-input.separate-dial-code.iti-sdc-3 .selected-flag {
        width: 68px;
    }

    .intl-tel-input.separate-dial-code.allow-dropdown.iti-sdc-3 input,
    .intl-tel-input.separate-dial-code.allow-dropdown.iti-sdc-3 input[type=text],
    .intl-tel-input.separate-dial-code.allow-dropdown.iti-sdc-3 input[type=tel] {
        padding-left: 84px;
    }

    .intl-tel-input.separate-dial-code.allow-dropdown.iti-sdc-3 .selected-flag {
        width: 78px;
    }

    .intl-tel-input.separate-dial-code.iti-sdc-4 input,
    .intl-tel-input.separate-dial-code.iti-sdc-4 input[type=text],
    .intl-tel-input.separate-dial-code.iti-sdc-4 input[type=tel] {
        padding-left: 82px;
    }

    .intl-tel-input.separate-dial-code.iti-sdc-4 .selected-flag {
        width: 76px;
    }

    .intl-tel-input.separate-dial-code.allow-dropdown.iti-sdc-4 input,
    .intl-tel-input.separate-dial-code.allow-dropdown.iti-sdc-4 input[type=text],
    .intl-tel-input.separate-dial-code.allow-dropdown.iti-sdc-4 input[type=tel] {
        padding-left: 92px;
    }

    .intl-tel-input.separate-dial-code.allow-dropdown.iti-sdc-4 .selected-flag {
        width: 86px;
    }

    .intl-tel-input.separate-dial-code.iti-sdc-5 input,
    .intl-tel-input.separate-dial-code.iti-sdc-5 input[type=text],
    .intl-tel-input.separate-dial-code.iti-sdc-5 input[type=tel] {
        padding-left: 90px;
    }

    .intl-tel-input.separate-dial-code.iti-sdc-5 .selected-flag {
        width: 84px;
    }

    .intl-tel-input.separate-dial-code.allow-dropdown.iti-sdc-5 input,
    .intl-tel-input.separate-dial-code.allow-dropdown.iti-sdc-5 input[type=text],
    .intl-tel-input.separate-dial-code.allow-dropdown.iti-sdc-5 input[type=tel] {
        padding-left: 100px;
    }

    .intl-tel-input.separate-dial-code.allow-dropdown.iti-sdc-5 .selected-flag {
        width: 94px;
    }

    .intl-tel-input.iti-container {
        position: absolute;
        top: -1000px;
        left: -1000px;
        z-index: 1060;
        padding: 1px;
    }

    .intl-tel-input.iti-container:hover {
        cursor: pointer;
    }

    .iti-mobile .intl-tel-input.iti-container {
        top: 30px;
        bottom: 30px;
        left: 30px;
        right: 30px;
        position: fixed;
    }

    .iti-mobile .intl-tel-input .country-list {
        max-height: 100%;
        width: 100%;
    }

    .iti-mobile .intl-tel-input .country-list .country {
        padding: 10px 10px;
        line-height: 1.5em;
    }

    .iti-flag {
        width: 20px;
    }

    .iti-flag.be {
        width: 18px;
    }

    .iti-flag.ch {
        width: 15px;
    }

    .iti-flag.mc {
        width: 19px;
    }

    .iti-flag.ne {
        width: 18px;
    }

    .iti-flag.np {
        width: 13px;
    }

    .iti-flag.va {
        width: 15px;
    }

    @media only screen and (-webkit-min-device-pixel-ratio: 2),
    only screen and (min--moz-device-pixel-ratio: 2),
    only screen and (-o-min-device-pixel-ratio: 2 / 1),
    only screen and (min-device-pixel-ratio: 2),
    only screen and (min-resolution: 192dpi),
    only screen and (min-resolution: 2dppx) {
        .iti-flag {
            background-size: 5630px 15px;
        }
    }

    .iti-flag.ac {
        height: 10px;
        background-position: 0px 0px;
    }

    .iti-flag.ad {
        height: 14px;
        background-position: -22px 0px;
    }

    .iti-flag.ae {
        height: 10px;
        background-position: -44px 0px;
    }

    .iti-flag.af {
        height: 14px;
        background-position: -66px 0px;
    }

    .iti-flag.ag {
        height: 14px;
        background-position: -88px 0px;
    }

    .iti-flag.ai {
        height: 10px;
        background-position: -110px 0px;
    }

    .iti-flag.al {
        height: 15px;
        background-position: -132px 0px;
    }

    .iti-flag.am {
        height: 10px;
        background-position: -154px 0px;
    }

    .iti-flag.ao {
        height: 14px;
        background-position: -176px 0px;
    }

    .iti-flag.aq {
        height: 14px;
        background-position: -198px 0px;
    }

    .iti-flag.ar {
        height: 13px;
        background-position: -220px 0px;
    }

    .iti-flag.as {
        height: 10px;
        background-position: -242px 0px;
    }

    .iti-flag.at {
        height: 14px;
        background-position: -264px 0px;
    }

    .iti-flag.au {
        height: 10px;
        background-position: -286px 0px;
    }

    .iti-flag.aw {
        height: 14px;
        background-position: -308px 0px;
    }

    .iti-flag.ax {
        height: 13px;
        background-position: -330px 0px;
    }

    .iti-flag.az {
        height: 10px;
        background-position: -352px 0px;
    }

    .iti-flag.ba {
        height: 10px;
        background-position: -374px 0px;
    }

    .iti-flag.bb {
        height: 14px;
        background-position: -396px 0px;
    }

    .iti-flag.bd {
        height: 12px;
        background-position: -418px 0px;
    }

    .iti-flag.be {
        height: 15px;
        background-position: -440px 0px;
    }

    .iti-flag.bf {
        height: 14px;
        background-position: -460px 0px;
    }

    .iti-flag.bg {
        height: 12px;
        background-position: -482px 0px;
    }

    .iti-flag.bh {
        height: 12px;
        background-position: -504px 0px;
    }

    .iti-flag.bi {
        height: 12px;
        background-position: -526px 0px;
    }

    .iti-flag.bj {
        height: 14px;
        background-position: -548px 0px;
    }

    .iti-flag.bl {
        height: 14px;
        background-position: -570px 0px;
    }

    .iti-flag.bm {
        height: 10px;
        background-position: -592px 0px;
    }

    .iti-flag.bn {
        height: 10px;
        background-position: -614px 0px;
    }

    .iti-flag.bo {
        height: 14px;
        background-position: -636px 0px;
    }

    .iti-flag.bq {
        height: 14px;
        background-position: -658px 0px;
    }

    .iti-flag.br {
        height: 14px;
        background-position: -680px 0px;
    }

    .iti-flag.bs {
        height: 10px;
        background-position: -702px 0px;
    }

    .iti-flag.bt {
        height: 14px;
        background-position: -724px 0px;
    }

    .iti-flag.bv {
        height: 15px;
        background-position: -746px 0px;
    }

    .iti-flag.bw {
        height: 14px;
        background-position: -768px 0px;
    }

    .iti-flag.by {
        height: 10px;
        background-position: -790px 0px;
    }

    .iti-flag.bz {
        height: 14px;
        background-position: -812px 0px;
    }

    .iti-flag.ca {
        height: 10px;
        background-position: -834px 0px;
    }

    .iti-flag.cc {
        height: 10px;
        background-position: -856px 0px;
    }

    .iti-flag.cd {
        height: 15px;
        background-position: -878px 0px;
    }

    .iti-flag.cf {
        height: 14px;
        background-position: -900px 0px;
    }

    .iti-flag.cg {
        height: 14px;
        background-position: -922px 0px;
    }

    .iti-flag.ch {
        height: 15px;
        background-position: -944px 0px;
    }

    .iti-flag.ci {
        height: 14px;
        background-position: -961px 0px;
    }

    .iti-flag.ck {
        height: 10px;
        background-position: -983px 0px;
    }

    .iti-flag.cl {
        height: 14px;
        background-position: -1005px 0px;
    }

    .iti-flag.cm {
        height: 14px;
        background-position: -1027px 0px;
    }

    .iti-flag.cn {
        height: 14px;
        background-position: -1049px 0px;
    }

    .iti-flag.co {
        height: 14px;
        background-position: -1071px 0px;
    }

    .iti-flag.cp {
        height: 14px;
        background-position: -1093px 0px;
    }

    .iti-flag.cr {
        height: 12px;
        background-position: -1115px 0px;
    }

    .iti-flag.cu {
        height: 10px;
        background-position: -1137px 0px;
    }

    .iti-flag.cv {
        height: 12px;
        background-position: -1159px 0px;
    }

    .iti-flag.cw {
        height: 14px;
        background-position: -1181px 0px;
    }

    .iti-flag.cx {
        height: 10px;
        background-position: -1203px 0px;
    }

    .iti-flag.cy {
        height: 13px;
        background-position: -1225px 0px;
    }

    .iti-flag.cz {
        height: 14px;
        background-position: -1247px 0px;
    }

    .iti-flag.de {
        height: 12px;
        background-position: -1269px 0px;
    }

    .iti-flag.dg {
        height: 10px;
        background-position: -1291px 0px;
    }

    .iti-flag.dj {
        height: 14px;
        background-position: -1313px 0px;
    }

    .iti-flag.dk {
        height: 15px;
        background-position: -1335px 0px;
    }

    .iti-flag.dm {
        height: 10px;
        background-position: -1357px 0px;
    }

    .iti-flag.do {
        height: 13px;
        background-position: -1379px 0px;
    }

    .iti-flag.dz {
        height: 14px;
        background-position: -1401px 0px;
    }

    .iti-flag.ea {
        height: 14px;
        background-position: -1423px 0px;
    }

    .iti-flag.ec {
        height: 14px;
        background-position: -1445px 0px;
    }

    .iti-flag.ee {
        height: 13px;
        background-position: -1467px 0px;
    }

    .iti-flag.eg {
        height: 14px;
        background-position: -1489px 0px;
    }

    .iti-flag.eh {
        height: 10px;
        background-position: -1511px 0px;
    }

    .iti-flag.er {
        height: 10px;
        background-position: -1533px 0px;
    }

    .iti-flag.es {
        height: 14px;
        background-position: -1555px 0px;
    }

    .iti-flag.et {
        height: 10px;
        background-position: -1577px 0px;
    }

    .iti-flag.eu {
        height: 14px;
        background-position: -1599px 0px;
    }

    .iti-flag.fi {
        height: 12px;
        background-position: -1621px 0px;
    }

    .iti-flag.fj {
        height: 10px;
        background-position: -1643px 0px;
    }

    .iti-flag.fk {
        height: 10px;
        background-position: -1665px 0px;
    }

    .iti-flag.fm {
        height: 11px;
        background-position: -1687px 0px;
    }

    .iti-flag.fo {
        height: 15px;
        background-position: -1709px 0px;
    }

    .iti-flag.fr {
        height: 14px;
        background-position: -1731px 0px;
    }

    .iti-flag.ga {
        height: 15px;
        background-position: -1753px 0px;
    }

    .iti-flag.gb {
        height: 10px;
        background-position: -1775px 0px;
    }

    .iti-flag.gd {
        height: 12px;
        background-position: -1797px 0px;
    }

    .iti-flag.ge {
        height: 14px;
        background-position: -1819px 0px;
    }

    .iti-flag.gf {
        height: 14px;
        background-position: -1841px 0px;
    }

    .iti-flag.gg {
        height: 14px;
        background-position: -1863px 0px;
    }

    .iti-flag.gh {
        height: 14px;
        background-position: -1885px 0px;
    }

    .iti-flag.gi {
        height: 10px;
        background-position: -1907px 0px;
    }

    .iti-flag.gl {
        height: 14px;
        background-position: -1929px 0px;
    }

    .iti-flag.gm {
        height: 14px;
        background-position: -1951px 0px;
    }

    .iti-flag.gn {
        height: 14px;
        background-position: -1973px 0px;
    }

    .iti-flag.gp {
        height: 14px;
        background-position: -1995px 0px;
    }

    .iti-flag.gq {
        height: 14px;
        background-position: -2017px 0px;
    }

    .iti-flag.gr {
        height: 14px;
        background-position: -2039px 0px;
    }

    .iti-flag.gs {
        height: 10px;
        background-position: -2061px 0px;
    }

    .iti-flag.gt {
        height: 13px;
        background-position: -2083px 0px;
    }

    .iti-flag.gu {
        height: 11px;
        background-position: -2105px 0px;
    }

    .iti-flag.gw {
        height: 10px;
        background-position: -2127px 0px;
    }

    .iti-flag.gy {
        height: 12px;
        background-position: -2149px 0px;
    }

    .iti-flag.hk {
        height: 14px;
        background-position: -2171px 0px;
    }

    .iti-flag.hm {
        height: 10px;
        background-position: -2193px 0px;
    }

    .iti-flag.hn {
        height: 10px;
        background-position: -2215px 0px;
    }

    .iti-flag.hr {
        height: 10px;
        background-position: -2237px 0px;
    }

    .iti-flag.ht {
        height: 12px;
        background-position: -2259px 0px;
    }

    .iti-flag.hu {
        height: 10px;
        background-position: -2281px 0px;
    }

    .iti-flag.ic {
        height: 14px;
        background-position: -2303px 0px;
    }

    .iti-flag.id {
        height: 14px;
        background-position: -2325px 0px;
    }

    .iti-flag.ie {
        height: 10px;
        background-position: -2347px 0px;
    }

    .iti-flag.il {
        height: 15px;
        background-position: -2369px 0px;
    }

    .iti-flag.im {
        height: 10px;
        background-position: -2391px 0px;
    }

    .iti-flag.in {
        height: 14px;
        background-position: -2413px 0px;
    }

    .iti-flag.io {
        height: 10px;
        background-position: -2435px 0px;
    }

    .iti-flag.iq {
        height: 14px;
        background-position: -2457px 0px;
    }

    .iti-flag.ir {
        height: 12px;
        background-position: -2479px 0px;
    }

    .iti-flag.is {
        height: 15px;
        background-position: -2501px 0px;
    }

    .iti-flag.it {
        height: 14px;
        background-position: -2523px 0px;
    }

    .iti-flag.je {
        height: 12px;
        background-position: -2545px 0px;
    }

    .iti-flag.jm {
        height: 10px;
        background-position: -2567px 0px;
    }

    .iti-flag.jo {
        height: 10px;
        background-position: -2589px 0px;
    }

    .iti-flag.jp {
        height: 14px;
        background-position: -2611px 0px;
    }

    .iti-flag.ke {
        height: 14px;
        background-position: -2633px 0px;
    }

    .iti-flag.kg {
        height: 12px;
        background-position: -2655px 0px;
    }

    .iti-flag.kh {
        height: 13px;
        background-position: -2677px 0px;
    }

    .iti-flag.ki {
        height: 10px;
        background-position: -2699px 0px;
    }

    .iti-flag.km {
        height: 12px;
        background-position: -2721px 0px;
    }

    .iti-flag.kn {
        height: 14px;
        background-position: -2743px 0px;
    }

    .iti-flag.kp {
        height: 10px;
        background-position: -2765px 0px;
    }

    .iti-flag.kr {
        height: 14px;
        background-position: -2787px 0px;
    }

    .iti-flag.kw {
        height: 10px;
        background-position: -2809px 0px;
    }

    .iti-flag.ky {
        height: 10px;
        background-position: -2831px 0px;
    }

    .iti-flag.kz {
        height: 10px;
        background-position: -2853px 0px;
    }

    .iti-flag.la {
        height: 14px;
        background-position: -2875px 0px;
    }

    .iti-flag.lb {
        height: 14px;
        background-position: -2897px 0px;
    }

    .iti-flag.lc {
        height: 10px;
        background-position: -2919px 0px;
    }

    .iti-flag.li {
        height: 12px;
        background-position: -2941px 0px;
    }

    .iti-flag.lk {
        height: 10px;
        background-position: -2963px 0px;
    }

    .iti-flag.lr {
        height: 11px;
        background-position: -2985px 0px;
    }

    .iti-flag.ls {
        height: 14px;
        background-position: -3007px 0px;
    }

    .iti-flag.lt {
        height: 12px;
        background-position: -3029px 0px;
    }

    .iti-flag.lu {
        height: 12px;
        background-position: -3051px 0px;
    }

    .iti-flag.lv {
        height: 10px;
        background-position: -3073px 0px;
    }

    .iti-flag.ly {
        height: 10px;
        background-position: -3095px 0px;
    }

    .iti-flag.ma {
        height: 14px;
        background-position: -3117px 0px;
    }

    .iti-flag.mc {
        height: 15px;
        background-position: -3139px 0px;
    }

    .iti-flag.md {
        height: 10px;
        background-position: -3160px 0px;
    }

    .iti-flag.me {
        height: 10px;
        background-position: -3182px 0px;
    }

    .iti-flag.mf {
        height: 14px;
        background-position: -3204px 0px;
    }

    .iti-flag.mg {
        height: 14px;
        background-position: -3226px 0px;
    }

    .iti-flag.mh {
        height: 11px;
        background-position: -3248px 0px;
    }

    .iti-flag.mk {
        height: 10px;
        background-position: -3270px 0px;
    }

    .iti-flag.ml {
        height: 14px;
        background-position: -3292px 0px;
    }

    .iti-flag.mm {
        height: 14px;
        background-position: -3314px 0px;
    }

    .iti-flag.mn {
        height: 10px;
        background-position: -3336px 0px;
    }

    .iti-flag.mo {
        height: 14px;
        background-position: -3358px 0px;
    }

    .iti-flag.mp {
        height: 10px;
        background-position: -3380px 0px;
    }

    .iti-flag.mq {
        height: 14px;
        background-position: -3402px 0px;
    }

    .iti-flag.mr {
        height: 14px;
        background-position: -3424px 0px;
    }

    .iti-flag.ms {
        height: 10px;
        background-position: -3446px 0px;
    }

    .iti-flag.mt {
        height: 14px;
        background-position: -3468px 0px;
    }

    .iti-flag.mu {
        height: 14px;
        background-position: -3490px 0px;
    }

    .iti-flag.mv {
        height: 14px;
        background-position: -3512px 0px;
    }

    .iti-flag.mw {
        height: 14px;
        background-position: -3534px 0px;
    }

    .iti-flag.mx {
        height: 12px;
        background-position: -3556px 0px;
    }

    .iti-flag.my {
        height: 10px;
        background-position: -3578px 0px;
    }

    .iti-flag.mz {
        height: 14px;
        background-position: -3600px 0px;
    }

    .iti-flag.na {
        height: 14px;
        background-position: -3622px 0px;
    }

    .iti-flag.nc {
        height: 10px;
        background-position: -3644px 0px;
    }

    .iti-flag.ne {
        height: 15px;
        background-position: -3666px 0px;
    }

    .iti-flag.nf {
        height: 10px;
        background-position: -3686px 0px;
    }

    .iti-flag.ng {
        height: 10px;
        background-position: -3708px 0px;
    }

    .iti-flag.ni {
        height: 12px;
        background-position: -3730px 0px;
    }

    .iti-flag.nl {
        height: 14px;
        background-position: -3752px 0px;
    }

    .iti-flag.no {
        height: 15px;
        background-position: -3774px 0px;
    }

    .iti-flag.np {
        height: 15px;
        background-position: -3796px 0px;
    }

    .iti-flag.nr {
        height: 10px;
        background-position: -3811px 0px;
    }

    .iti-flag.nu {
        height: 10px;
        background-position: -3833px 0px;
    }

    .iti-flag.nz {
        height: 10px;
        background-position: -3855px 0px;
    }

    .iti-flag.om {
        height: 10px;
        background-position: -3877px 0px;
    }

    .iti-flag.pa {
        height: 14px;
        background-position: -3899px 0px;
    }

    .iti-flag.pe {
        height: 14px;
        background-position: -3921px 0px;
    }

    .iti-flag.pf {
        height: 14px;
        background-position: -3943px 0px;
    }

    .iti-flag.pg {
        height: 15px;
        background-position: -3965px 0px;
    }

    .iti-flag.ph {
        height: 10px;
        background-position: -3987px 0px;
    }

    .iti-flag.pk {
        height: 14px;
        background-position: -4009px 0px;
    }

    .iti-flag.pl {
        height: 13px;
        background-position: -4031px 0px;
    }

    .iti-flag.pm {
        height: 14px;
        background-position: -4053px 0px;
    }

    .iti-flag.pn {
        height: 10px;
        background-position: -4075px 0px;
    }

    .iti-flag.pr {
        height: 14px;
        background-position: -4097px 0px;
    }

    .iti-flag.ps {
        height: 10px;
        background-position: -4119px 0px;
    }

    .iti-flag.pt {
        height: 14px;
        background-position: -4141px 0px;
    }

    .iti-flag.pw {
        height: 13px;
        background-position: -4163px 0px;
    }

    .iti-flag.py {
        height: 11px;
        background-position: -4185px 0px;
    }

    .iti-flag.qa {
        height: 8px;
        background-position: -4207px 0px;
    }

    .iti-flag.re {
        height: 14px;
        background-position: -4229px 0px;
    }

    .iti-flag.ro {
        height: 14px;
        background-position: -4251px 0px;
    }

    .iti-flag.rs {
        height: 14px;
        background-position: -4273px 0px;
    }

    .iti-flag.ru {
        height: 14px;
        background-position: -4295px 0px;
    }

    .iti-flag.rw {
        height: 14px;
        background-position: -4317px 0px;
    }

    .iti-flag.sa {
        height: 14px;
        background-position: -4339px 0px;
    }

    .iti-flag.sb {
        height: 10px;
        background-position: -4361px 0px;
    }

    .iti-flag.sc {
        height: 10px;
        background-position: -4383px 0px;
    }

    .iti-flag.sd {
        height: 10px;
        background-position: -4405px 0px;
    }

    .iti-flag.se {
        height: 13px;
        background-position: -4427px 0px;
    }

    .iti-flag.sg {
        height: 14px;
        background-position: -4449px 0px;
    }

    .iti-flag.sh {
        height: 10px;
        background-position: -4471px 0px;
    }

    .iti-flag.si {
        height: 10px;
        background-position: -4493px 0px;
    }

    .iti-flag.sj {
        height: 15px;
        background-position: -4515px 0px;
    }

    .iti-flag.sk {
        height: 14px;
        background-position: -4537px 0px;
    }

    .iti-flag.sl {
        height: 14px;
        background-position: -4559px 0px;
    }

    .iti-flag.sm {
        height: 15px;
        background-position: -4581px 0px;
    }

    .iti-flag.sn {
        height: 14px;
        background-position: -4603px 0px;
    }

    .iti-flag.so {
        height: 14px;
        background-position: -4625px 0px;
    }

    .iti-flag.sr {
        height: 14px;
        background-position: -4647px 0px;
    }

    .iti-flag.ss {
        height: 10px;
        background-position: -4669px 0px;
    }

    .iti-flag.st {
        height: 10px;
        background-position: -4691px 0px;
    }

    .iti-flag.sv {
        height: 12px;
        background-position: -4713px 0px;
    }

    .iti-flag.sx {
        height: 14px;
        background-position: -4735px 0px;
    }

    .iti-flag.sy {
        height: 14px;
        background-position: -4757px 0px;
    }

    .iti-flag.sz {
        height: 14px;
        background-position: -4779px 0px;
    }

    .iti-flag.ta {
        height: 10px;
        background-position: -4801px 0px;
    }

    .iti-flag.tc {
        height: 10px;
        background-position: -4823px 0px;
    }

    .iti-flag.td {
        height: 14px;
        background-position: -4845px 0px;
    }

    .iti-flag.tf {
        height: 14px;
        background-position: -4867px 0px;
    }

    .iti-flag.tg {
        height: 13px;
        background-position: -4889px 0px;
    }

    .iti-flag.th {
        height: 14px;
        background-position: -4911px 0px;
    }

    .iti-flag.tj {
        height: 10px;
        background-position: -4933px 0px;
    }

    .iti-flag.tk {
        height: 10px;
        background-position: -4955px 0px;
    }

    .iti-flag.tl {
        height: 10px;
        background-position: -4977px 0px;
    }

    .iti-flag.tm {
        height: 14px;
        background-position: -4999px 0px;
    }

    .iti-flag.tn {
        height: 14px;
        background-position: -5021px 0px;
    }

    .iti-flag.to {
        height: 10px;
        background-position: -5043px 0px;
    }

    .iti-flag.tr {
        height: 14px;
        background-position: -5065px 0px;
    }

    .iti-flag.tt {
        height: 12px;
        background-position: -5087px 0px;
    }

    .iti-flag.tv {
        height: 10px;
        background-position: -5109px 0px;
    }

    .iti-flag.tw {
        height: 14px;
        background-position: -5131px 0px;
    }

    .iti-flag.tz {
        height: 14px;
        background-position: -5153px 0px;
    }

    .iti-flag.ua {
        height: 14px;
        background-position: -5175px 0px;
    }

    .iti-flag.ug {
        height: 14px;
        background-position: -5197px 0px;
    }

    .iti-flag.um {
        height: 11px;
        background-position: -5219px 0px;
    }

    .iti-flag.us {
        height: 11px;
        background-position: -5241px 0px;
    }

    .iti-flag.uy {
        height: 14px;
        background-position: -5263px 0px;
    }

    .iti-flag.uz {
        height: 10px;
        background-position: -5285px 0px;
    }

    .iti-flag.va {
        height: 15px;
        background-position: -5307px 0px;
    }

    .iti-flag.vc {
        height: 14px;
        background-position: -5324px 0px;
    }

    .iti-flag.ve {
        height: 14px;
        background-position: -5346px 0px;
    }

    .iti-flag.vg {
        height: 10px;
        background-position: -5368px 0px;
    }

    .iti-flag.vi {
        height: 14px;
        background-position: -5390px 0px;
    }

    .iti-flag.vn {
        height: 14px;
        background-position: -5412px 0px;
    }

    .iti-flag.vu {
        height: 12px;
        background-position: -5434px 0px;
    }

    .iti-flag.wf {
        height: 14px;
        background-position: -5456px 0px;
    }

    .iti-flag.ws {
        height: 10px;
        background-position: -5478px 0px;
    }

    .iti-flag.xk {
        height: 15px;
        background-position: -5500px 0px;
    }

    .iti-flag.ye {
        height: 14px;
        background-position: -5522px 0px;
    }

    .iti-flag.yt {
        height: 14px;
        background-position: -5544px 0px;
    }

    .iti-flag.za {
        height: 14px;
        background-position: -5566px 0px;
    }

    .iti-flag.zm {
        height: 14px;
        background-position: -5588px 0px;
    }

    .iti-flag.zw {
        height: 10px;
        background-position: -5610px 0px;
    }

    .iti-flag {
        width: 20px;
        height: 15px;
        box-shadow: 0px 0px 1px 0px #888;
        background-image: url("https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/img/flags.png");
        background-repeat: no-repeat;
        background-color: #DBDBDB;
        background-position: 20px 0;
    }

    @media only screen and (-webkit-min-device-pixel-ratio: 2),
    only screen and (min--moz-device-pixel-ratio: 2),
    only screen and (-o-min-device-pixel-ratio: 2 / 1),
    only screen and (min-device-pixel-ratio: 2),
    only screen and (min-resolution: 192dpi),
    only screen and (min-resolution: 2dppx) {
        .iti-flag {
            background-image: url("https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/img/flags@2x.png");
        }
    }

    .iti-flag.np {
        background-color: transparent;
    }



    .hide {
        display: none;
    }

    pre {
        margin: 0 !important;
        display: inline-block;
    }

    .token.operator,
    .token.entity,
    .token.url,
    .language-css .token.string,
    .style .token.string,
    .token.variable {
        background: none;
    }


    ::-moz-placeholder {
        /* Firefox 19+ */
        color: #BBB;
        opacity: 1;
    }

    :-ms-input-placeholder {
        color: #BBB;
    }


    #result {
        margin-bottom: 100px;
    }

    .nice-select .current {
        color: #ffc107 !important;
    }
</style>


<form action="<?= base_url('b2c/booking-confirm?serviceId=' . $sid) ?>" method="POST">
    <div class="booking-form-wrap mb-40">

        <h4 style="font-size: 16px;"><?= substr($sTitle, 0, 25) . '...' ?? '' ?></h4>
        <hr>
        <!-- <p>Reserve your ideal trip early for a hassle-free trip; secure comfort and convenience!</p> -->

        <!-- contact Info -->
        <div class="sidebar-booking-form">
            <div class="form-inner mb-20">
                <label>Lead Name <span>*</span></label>
                <input type="hidden" name="tourType" value="<?= $type; ?>" placeholder="tour Type">
                <input type="hidden" name="vehicle_code" value="NULL" placeholder="vehicle code">
                <input type="hidden" name="pickupTime" value="NULL" placeholder="pickup Time">
                <input type="hidden" name="pickupLoc" value="NULL" placeholder="pickup Time">
                <input type="hidden" name="dropOffLoc" value="NULL" placeholder="pickup Time">

                <input type="text" name="customer_name" value="<?= set_value('customer_name'); ?>" placeholder="Enter your full Lead Name">
                <?= '<small>' . $this->form_validation->error('customer_name') . '</small>' ?>
            </div>
            <div class="form-inner mb-20">
                <label>Email Address <span>*</span></label>
                <input type="email" name="customer_email" value="<?= set_value('customer_email'); ?>" placeholder="Enter your email address">
                <?= '<small>' . $this->form_validation->error('customer_email') . '</small>' ?>
            </div>
            <div class="form-inner mb-20">
                <label>Phone Number <span>*</span></label>
                <div class="select-box">
                    <div class="selected-option">
                        <div>
                            <span class="iconify" data-icon="flag:ae-4x3"></span>
                            <strong>+971</strong>
                        </div>
                        <input type="tel" name="customer_number" value="<?= (set_value('customer_number')) ? set_value('customer_number') : '+971'; ?>" placeholder="Phone Number">
                    </div>
                    <div class="options" style="z-index: 1;">
                        <input type="text" class="search-box" placeholder="Search Country Name">
                        <ol>

                        </ol>
                    </div>
                </div>
                <small><span id="valid-msg" class="hide"></span>
                    <span id="error-msg" class="hide" style="color: #dc3545;text-align: justify;font-family: var(--font-jost);font-size: 12px;font-weight: 300;line-height: 32px;"><b>Invalid!</b> Please enter a valid phone number </span></small>
                <?= '<small>' . $this->form_validation->error('customer_number') . '</small>' ?>
            </div>
        </div>
        <!-- end contact Info -->
        <hr>
        <div class="tab-content" id="v-pills-tabContent2">
            <div class="tab-pane fade active show" id="v-pills-booking" role="tabpanel" aria-labelledby="v-pills-booking-tab">
                <div class="sidebar-booking-form">
                    <div class="tour-date-wrap mb-25">
                        <h6>Select Your Travel Date:</h6>

                        <div class="form-check customdate">
                            <!-- <input class="form-check-input" type="radio" name="tourDate" id="Coustom" value="option1" checked> -->
                            <label class="form-check-label" for="Coustom">
                            </label>
                            <span class="form-group">
                                <input type="date" name="tourDate" placeholder="5 Mar, 2024" value="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15">
                                    <path d="M10.3125 7.03125C10.3125 6.90693 10.3619 6.7877 10.4498 6.69979C10.5377 6.61189 10.6569 6.5625 10.7812 6.5625H11.7188C11.8431 6.5625 11.9623 6.61189 12.0502 6.69979C12.1381 6.7877 12.1875 6.90693 12.1875 7.03125V7.96875C12.1875 8.09307 12.1381 8.2123 12.0502 8.30021C11.9623 8.38811 11.8431 8.4375 11.7188 8.4375H10.7812C10.6569 8.4375 10.5377 8.38811 10.4498 8.30021C10.3619 8.2123 10.3125 8.09307 10.3125 7.96875V7.03125Z" />
                                    <path d="M3.28125 0C3.40557 0 3.5248 0.049386 3.61271 0.137294C3.70061 0.225201 3.75 0.34443 3.75 0.46875V0.9375H11.25V0.46875C11.25 0.34443 11.2994 0.225201 11.3873 0.137294C11.4752 0.049386 11.5944 0 11.7188 0C11.8431 0 11.9623 0.049386 12.0502 0.137294C12.1381 0.225201 12.1875 0.34443 12.1875 0.46875V0.9375H13.125C13.6223 0.9375 14.0992 1.13504 14.4508 1.48667C14.8025 1.83831 15 2.31522 15 2.8125V13.125C15 13.6223 14.8025 14.0992 14.4508 14.4508C14.0992 14.8025 13.6223 15 13.125 15H1.875C1.37772 15 0.900806 14.8025 0.549175 14.4508C0.197544 14.0992 0 13.6223 0 13.125V2.8125C0 2.31522 0.197544 1.83831 0.549175 1.48667C0.900806 1.13504 1.37772 0.9375 1.875 0.9375H2.8125V0.46875C2.8125 0.34443 2.86189 0.225201 2.94979 0.137294C3.0377 0.049386 3.15693 0 3.28125 0V0ZM1.875 1.875C1.62636 1.875 1.3879 1.97377 1.21209 2.14959C1.03627 2.3254 0.9375 2.56386 0.9375 2.8125V13.125C0.9375 13.3736 1.03627 13.6121 1.21209 13.7879C1.3879 13.9637 1.62636 14.0625 1.875 14.0625H13.125C13.3736 14.0625 13.6121 13.9637 13.7879 13.7879C13.9637 13.6121 14.0625 13.3736 14.0625 13.125V2.8125C14.0625 2.56386 13.9637 2.3254 13.7879 2.14959C13.6121 1.97377 13.3736 1.875 13.125 1.875H1.875Z" />
                                    <path d="M2.34375 3.75C2.34375 3.62568 2.39314 3.50645 2.48104 3.41854C2.56895 3.33064 2.68818 3.28125 2.8125 3.28125H12.1875C12.3118 3.28125 12.431 3.33064 12.519 3.41854C12.6069 3.50645 12.6562 3.62568 12.6562 3.75V4.6875C12.6562 4.81182 12.6069 4.93105 12.519 5.01896C12.431 5.10686 12.3118 5.15625 12.1875 5.15625H2.8125C2.68818 5.15625 2.56895 5.10686 2.48104 5.01896C2.39314 4.93105 2.34375 4.81182 2.34375 4.6875V3.75Z" />
                                </svg>
                            </span>
                        </div>
                        <?= '<small>' . $this->form_validation->error('tourDate') . '</small>' ?>
                    </div>
                    <div class="tour-date-wrap mb-50">
                        <h6>Transfer Options:</h6>
                        <select name="transfer_option" id="transfer_option">
                            <option value="without-transfers">Without Transfers</option>
                            <option value="private-transfers">Private Transfers</option>
                        </select>
                    </div>
                    <!-- slot -->
                    <div class="row mt-25">

                        <?php
                        if (strtolower($type) == "slot_PROGRESS") {
                            echo ' <h6 class="mb-25">Select Slot (In Working ...)</h6>';
                            $slt = json_decode($tSlot);
                            // pre($slots);
                            // die;
                            $i = 0;
                            foreach ($slt as $key => $s) {
                                $i++; ?>
                                <div class="col-3 mb-3 slot-wraper">
                                    <input type="checkbox" class="slots" id="<?= $key; ?>" value="<?= $s ?>">
                                    <label href="#0" data-price="<?= $s; ?>" class="btn btn-sm btn-info w-100 button_slots" for="<?= $key; ?>">
                                        <strong><?= $key ?></strong><br>
                                        <small style="font-size: x-small;"><i><?= $s . ' AED'; ?></i></small>
                                    </label>
                                </div>
                        <?php }
                        }

                        ?>

                    </div>
                    <!-- endslot -->
                    <div class="booking-form-item-type mb-45">
                        <h6>Select Number Of Participant:</h6>
                        <div class="number-input-item adults">
                            <label class="number-input-lable"><?= (($pChild == '0' || $pChild == '0.00')) ? 'Price' : 'Adult'; ?>: <small><?= $pAdultL ?></small><span>
                                </span><span> <?= $pAdult; ?> </span></label>
                            <div class="quantity-counter">
                                <a href="#" id="quantity_minus_adult" class="quantity__minus_disabled"><i class="bi bi-dash"></i></a>
                                <input name="quantity_adult" id="quantity_input_adult" type="text" class="quantity__input_disabled" min="0" value="0" required>
                                <a href="#" id="quantity_plus_adult" class="quantity__plus_disabled"><i class="bi bi-plus"></i></a>
                            </div>
                            <?= '<small>' . $this->form_validation->error('quantity_input_adult') . '</small>' ?>
                        </div>
                        <?php if ($pChild != '0' || $pChild != '0.00') { ?>
                            <div class="number-input-item children">
                                <label class="number-input-lable">Child: <small><?= $pChildL ?></small><span>
                                    </span><span><?= $pChild; ?></span></label>
                                <div class="quantity-counter">
                                    <a href="#" id="quantity_minus_child" class="quantity__minus_disabled"><i class="bi bi-dash"></i></a>
                                    <input name="quantity_child" id="quantity_input_child" type="text" class="quantity__input_disabled" min="0" value="0" required>
                                    <a href="#" id="quantity_plus_child" class="quantity__plus_disabled"><i class="bi bi-plus"></i></a>
                                </div>
                                <?= '<small>' . $this->form_validation->error('quantity_input_child') . '</small>' ?>
                            </div>
                        <?php } else { ?>
                            <input name="quantity_child" id="quantity_input_child" type="hidden" class="quantity__input_disabled" min="0" value="0" required>
                        <?php  } ?>
                        <?php if ($baby_seats) { ?>
                            <hr>
                            <div class="accordion" id="accordionBabySeat">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" for="baby_seat" id="headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBsOne" aria-expanded="true" aria-controls="collapseBsOne">
                                            <div class="children">
                                                <!-- <input type="checkbox" name="baby_seat" id="baby_seat" value=""> -->
                                                <label class="number-input-lable" for="baby_seat">Add Child/Baby Seats<span>
                                            </div>
                                        </button>
                                    </h2>
                                    <div id="collapseBsOne" class="accordion-collapse collapse " aria-labelledby="headingOne" data-bs-parent="#accordionBabySeat">
                                        <div class="accordion-body">
                                            <?php if ($babySeatOp->bsLabel[0]) {
                                                $bsLen = count($babySeatOp->bsLabel);
                                                $specialChar = array('`', '~', '!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '-', '_', '+', '=', '{', '}', '[', ']', ';', ':', '"', "'", ',', '.', '<', '>', '/', '?', '|', '\\', " ");

                                                for ($i = 0; $i < $bsLen; $i++) {

                                                    $fl_babySeat = str_replace($specialChar, '_', strtolower($babySeatOp->bsLabel[$i]));
                                            ?>
                                                    <div class="number-input-item adults">
                                                        <small style="line-height: normal;"><strong><?= $babySeatOp->bsLabel[$i] ?? '' ?></strong>
                                                            <br> <small style="color: #aaa;"><?= $babySeatOp->bsAges[$i] ?? '' ?></small>
                                                        </small>
                                                        </span><small><?= $babySeatOp->bsPrice[$i] ?? '0'; ?> AED</small></span>
                                                        <div class="quantity-counter" style="width: 100px;">
                                                            <a href="javascript:void(0);" id="<?= 'quantity_minus_babySeat' . $i ?>" onclick="sub_baby_seat_price(this)" data-price="<?= $babySeatOp->bsPrice[$i] ?? '0'; ?>" data-input="<?= 'quantity_input_babySeat_' . $i ?>" class="quantity__minus_disabled"><i class="bi bi-dash"></i></a>
                                                            <input type="text" name="babySeat_qty[<?= $fl_babySeat ?>]" style="padding: 0;" id="<?= 'quantity_input_babySeat_' . $i ?>" class="quantity__input_disabled" min="0" max="<?= (int) $passengers; ?>" value="0" required>
                                                            <!--  'bs_qty_'.$fl_babySeat  -->
                                                            <a href="javascript:void(0);" id="<?= 'quantity_plus_babySeat' . $i ?>" onclick="add_baby_seat_price(this)" data-price="<?= $babySeatOp->bsPrice[$i] ?? '0'; ?>" data-input="<?= 'quantity_input_babySeat_' . $i ?>" class="quantity__plus_disabled"><i class="bi bi-plus"></i></a>
                                                        </div>

                                                    </div>
                                                <?php }
                                            } else { ?>
                                                <div class="number-input-item adults">
                                                    <small style="line-height: normal;"><strong>Child/Baby Seat</strong>
                                                        <br> <small style="color: #aaa;"></small>
                                                    </small>
                                                    </span><small> 25 AED</small></span>
                                                    <div class="quantity-counter" style="width: 100px;">
                                                        <a href="javascript:void(0);" id="<?= 'quantity_minus_babySeat0' ?>" onclick="sub_baby_seat_price(this)" data-price="25" data-input="<?= 'quantity_input_babySeat_0' ?>" class="quantity__minus_disabled"><i class="bi bi-dash"></i></a>
                                                        <input type="text" name="babySeat_qty[baby_seat]" style="padding: 0;" id="<?= 'quantity_input_babySeat_0' ?>" class="quantity__input_disabled" min="0" max="<?= (int) $passengers; ?>" value="0" required>
                                                        <a href="javascript:void(0);" id="<?= 'quantity_plus_babySeat0' ?>" onclick="add_baby_seat_price(this)" data-price="25" data-input="<?= 'quantity_input_babySeat_0' ?>" class="quantity__plus_disabled"><i class="bi bi-plus"></i></a>
                                                    </div>

                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        <?php } ?>
                    </div>

                    <div class="booking-form-item-type">
                        <div class="single-total mb-30">
                            <span>Adult</span>
                            <ul>
                                <li><strong><?= $pAdult . " AED"; ?></strong> PRICE</li>
                                <li><i class="bi bi-x-lg"></i></li>
                                <li><strong id="quantity_span_adult">01</strong> QTY</li>

                            </ul>
                            <svg xmlns="http://www.w3.org/2000/svg" width="27" height="15" viewBox="0 0 27 15">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M23.999 5.44668L25.6991 7.4978L23.9991 9.54878H0V10.5743H23.1491L20.0135 14.3575L20.7834 14.9956L26.7334 7.81687L26.9979 7.4978L26.7334 7.17873L20.7834 0L20.0135 0.638141L23.149 4.42114H0V5.44668H23.999Z" />
                            </svg>
                            <div class="total" id="total_price_adult"><?= $pAdult . " AED"; ?></div>
                        </div>

                    </div>
                    <input type="hidden" name="price_total" id="totalPrice_hidden" value="0">
                    <input type="hidden" name="price_child" id="" value="<?= $pChild; ?>">
                    <input type="hidden" name="price_adult" id="" value="<?= $pAdult; ?>">
                    <input type="hidden" name="slot_no" id="slot_no" value="NULL">
                    <!-- <input type="hidden" name="customer_number" id="customer_number_valid" value="" required> -->
                    <?php if($trspTax != '' && $trspTax != '0'){ ?>
                    <div class="transportTax" style="display: flex;justify-content: space-between;"><span>Charges:</span><strong id="transportTax"><?php echo $trspTax ?? 0; ?> <small>AED</small></strong></div>
                    <?php } ?>
                    <div class="total-price"><span>Total Price:</span><strong id="totalPrice">0.00 <small>AED</small></strong></div>
                    <?= '<small>' . $this->form_validation->error('totalPrice_hidden') . '</small>' ?>
                    <button type="submit" id="btnSubmit" class="primary-btn1 two">Book Now</button>
                </div>
            </div>


        </div>
    </div>
</form>

<script src="<?php echo base_url(); ?>assets/admin/js/jQuery-2.1.4.min.js" type="text/javascript"></script>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/intlTelInput.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/intlTelInput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/utils.js"></script>
<script>
    var telInput = $("#phone"),
        errorMsg = $("#error-msg"),
        validMsg = $("#valid-msg");

    // initialise plugin
    telInput.intlTelInput({

        allowExtensions: true,
        formatOnDisplay: true,
        autoFormat: true,
        autoHideDialCode: true,
        autoPlaceholder: true,
        defaultCountry: "ae",
        ipinfoToken: "yolo",

        nationalMode: false,
        numberType: "MOBILE",
        //onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
        preferredCountries: ['ae', 'sa', 'qa', 'om', 'bh', 'kw', 'ma'],
        preventInvalidNumbers: true,
        separateDialCode: true,
        initialCountry: "ae",
        geoIpLookup: function(callback) {
            $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
                var countryCode = (resp && resp.country) ? resp.country : "";
                callback(countryCode);
            });
        },
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/utils.js"
    });

    function callback(c) {
        console.log(c);
    }
    var reset = function() {

        telInput.removeClass("error");
        errorMsg.addClass("hide");
        validMsg.addClass("hide");
    };

    // on blur: validate
    telInput.blur(function() {
        reset();
        if ($.trim(telInput.val())) {
            if (telInput.intlTelInput("isValidNumber")) {
                validMsg.removeClass("hide");

                $('#btnSubmit').removeAttr('disabled');
                $('#btnSubmit').removeClass('btn');
                $('#btnSubmit').removeClass('btn-secondary');
                // set_valid_num();
            } else {
                telInput.addClass("error");
                errorMsg.removeClass("hide");
                $('#btnSubmit').attr('disabled', 'disabled');
                $('#btnSubmit').addClass('btn');
                $('#btnSubmit').addClass('btn-secondary');
                $('#customer_number_valid').val('');

            }
        }
    });

    function set_valid_num() {
        $('#customer_number_valid').val('');

        let countryCode = $.trim($('.selected-dial-code').text());
        countryCode = $.trim(countryCode.replace('+', ''));
        let inp_val = $.trim(telInput.val());
        if (inp_val.includes(countryCode) == false) {
            let full_number = countryCode + inp_val;
            full_number = full_number.replace(/\s/g, '');
            $('#customer_number_valid').val(full_number);
        }
    }
    // on keyup / change flag: reset
    telInput.on("keyup change", reset);
</script>

<script>
    // $(document).ready(function() {

        var adultPrice = <?= $pAdult; ?> // Price for each adult
        var adultPriceTotal = <?= $pAdult; ?> // Price for each adult
        var childPriceTotal = <?= $pAdult; ?> // Price for each adult
        var childPrice = <?= $pChild; ?>; // Price for each child
        var total_capacity = <?= $passengers; ?>; // Price for each child
        var numAdults = 0;
        var numChildren = 0;
        var totalPrice = 0;

        var totalBsPrice = 0;
        var addBabySeatPrice = false;
        var transportTax = '<?php echo $trspTax ?? 0; ?>';

        // Function to update total price
        function updateTotalPrice() {
      totalPrice = ((adultPrice * numAdults) + ((childPrice * numChildren)) + totalBsPrice) + parseInt(transportTax);

      $("#totalPrice").text(totalPrice + " AED");
      $("#totalPrice_hidden").val(totalPrice + " AED");
    }
        // function updateTotalPrice() {

            
        //     totalPrice = (adultPrice * numAdults) + ((childPrice * numChildren));

        //     var baby_seat = $('#baby_seat').is(':checked');

        //     if (baby_seat == 1 && addBabySeatPrice == true) {
        //         totalPrice = (totalPrice + 25);
        //     }

        //     $("#totalPrice").text(totalPrice + " AED");
        //     $("#totalPrice_hidden").val(totalPrice + " AED");
        // }

        // Function to update Adult total price
        function updateTotalPriceAdult() {
            var adultPriceTotal = (adultPrice * numAdults);
            $("#total_price_adult").text(adultPriceTotal + " AED");
        }
        // Function to update Child total price
        function updateTotalPriceChild() {
            var childPriceTotal = (childPrice * numChildren);
            $("#total_price_child").text(childPriceTotal + " AED");
        }

        // Add adult
        $("#quantity_plus_adult").click(function(e) {
            e.preventDefault();
            quantityAdult = $("#quantity_input_adult").val();
            value = parseInt(quantityAdult)
            $("#quantity_input_adult").val((value + 1));
            quantityAdult = $("#quantity_input_adult").val();

            if (quantityAdult >= 0) {
                numAdults = quantityAdult;
            } else {
                numAdults = 0
            }
            updateTotalPrice();
            $("#quantity_span_adult").text(quantityAdult);
            updateTotalPriceAdult();

        });

        // Subtract adult
        $("#quantity_minus_adult").click(function(e) {
            e.preventDefault();
            quantityAdult = $("#quantity_input_adult").val();

            if (quantityAdult > 0) {
                value = parseInt(quantityAdult)
                $("#quantity_input_adult").val((value - 1));
            }
            quantityAdult = $("#quantity_input_adult").val();

            if (quantityAdult <= 0) {
                numAdults = 0;
            } else {
                numAdults = quantityAdult
            }

            if (quantityAdult >= 0) {
                // numAdults = quantityAdult;
                updateTotalPrice();
                $("#quantity_span_adult").text(quantityAdult);
                updateTotalPriceAdult();
            }
        });

        function add_baby_seat_price(vls){
    let bsPrice = $(vls).data('price');
     let inputId = $(vls).data('input');
     let inpVl = $("#"+inputId).val();
     inpVl = parseInt(inpVl);
     if (inpVl < total_capacity) {
       $("#"+inputId).val((inpVl + 1));
       totalBsPrice = totalBsPrice + bsPrice;
       updateTotalPrice();
      }
    }

  function sub_baby_seat_price(vls){
    let bsPrice = $(vls).data('price');
     let inputId = $(vls).data('input');
     let inpVl = $("#"+inputId).val();
     inpVl = parseInt(inpVl);
     if (inpVl > 0) {
       $("#"+inputId).val((inpVl - 1));
       totalBsPrice = totalBsPrice - bsPrice;

       updateTotalPrice();

      }
    }
        // Add child
        // $("#quantity_minus_child").click(function(e) {

        //     e.preventDefault();
        //     quantitychild = $("#quantity_input_child").val();
        //     if (quantitychild > 0) {
        //         value = parseInt(quantitychild)
        //         $("#quantity_input_child").val((value - 1));
        //     }
        //     quantitychild = $("#quantity_input_child").val();

        //     if (quantitychild <= 0) {
        //         numChildren = 0;
        //     } else {
        //         numChildren = quantitychild
        //     }

        //     updateTotalPrice();
        //     $("#quantity_span_child").text(quantitychild);
        //     updateTotalPriceChild();
        // });

        // add child
        // $("#quantity_plus_child").click(function(e) {
        //     e.preventDefault();
        //     quantitychild = $("#quantity_input_child").val();
        //     value = parseInt(quantitychild)
        //     $("#quantity_input_child").val((value + 1));
        //     quantitychild = $("#quantity_input_child").val();

        //     if (quantitychild >= 0) {
        //         numChildren = quantitychild
        //     } else {
        //         numChildren = 0;
        //     }
        //     if (quantitychild > 0) {
        //         ;

        //         updateTotalPrice();

        //         $("#quantity_span_child").text(quantitychild);
        //         updateTotalPriceChild();
        //     }
        // });

        // 		baby Seat price add
        // $("#baby_seat").click(function() {
        //     baby_seat = $('#baby_seat').is(':checked');

        //     if (baby_seat) {
        //         addBabySeatPrice = true;
        //     } else {

        //         addBabySeatPrice = false;
        //     }

        //     updateTotalPrice();
        // });

    // });
</script>
<!--end prices-->

<script>
    function getCheckedCheckboxes() {
        var checkboxes = document.querySelectorAll('.slots');
        var checkedCheckboxes = [];

        var i = 0;
        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                i++;
                checkedCheckboxes.push(parseInt(checkbox.value));
                // checkedCheckboxes = checkbox.value;
            }
        });

        var jsonArray = JSON.stringify(checkedCheckboxes);

        if (checkedCheckboxes) {
            var sum = sumArray(checkedCheckboxes);
            // var s = document.getElementById('slot_no');
            // s.value = jsonArray;
            alert(sum);
        }

    }

    function sumArray(array) {
        return array.reduce(function(accumulator, currentValue) {
            return accumulator + currentValue;
        }, 0); // Start with an initial value of 0
    }

    function validateSlot() {
        document.querySelectorAll('.button_slots').forEach(button => {
            button.addEventListener('click', function() {
                // Toggle between 'success' and 'info' classes for all buttons
                document.querySelectorAll('.button_slots').forEach(button => {

                    this.classList.toggle("btn-danger");
                    if (this.classList.contains("btn-info")) {
                        this.classList.remove("btn-info");
                        this.classList.add("btn-danger");
                        // alert($(this).data('price'))
                        // getCheckedCheckboxes();
                    } else if (button.classList.contains("btn-danger")) {
                        button.classList.remove("btn-danger");
                        button.classList.add("btn-info");
                    }

                });

            });


        });
    }

    

    validateSlot();
</script>