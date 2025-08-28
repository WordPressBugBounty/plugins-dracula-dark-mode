/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "../src/js/components/ProModal.js":
/*!****************************************!*\
  !*** ../src/js/components/ProModal.js ***!
  \****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ ProModal),
/* harmony export */   showProModal: () => (/* binding */ showProModal)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);

const {
  useEffect,
  useState
} = React;
function ProModal({
  text = wp.i18n.__('Upgrade to Pro to unlock this feature.', 'dracula-dark-mode'),
  isDismissable = true,
  watchVideo = false
}) {
  const [isOpen, setIsOpen] = useState(true);
  useEffect(() => {
    const $ = jQuery;

    // On click outside modal close modal using jQuery
    if (isDismissable) {
      $(document).on('click', '.dracula-pro-modal-wrap', function (e) {
        if ($(e.target).hasClass('dracula-pro-modal-wrap')) {
          setIsOpen(false);
        }
      });
    }

    // Timer
    function updateTimer() {
      const now = new Date().getTime();
      let distance = targetTime - now;

      // If the count down is over, reset it
      if (distance < 0) {
        setNewTargetTime();
        distance = targetTime - now;
      }

      // Time calculations for days, hours, minutes and seconds
      const days = Math.floor(distance / (1000 * 60 * 60 * 24));
      const hours = Math.floor(distance % (1000 * 60 * 60 * 24) / (1000 * 60 * 60));
      const minutes = Math.floor(distance % (1000 * 60 * 60) / (1000 * 60));
      const seconds = Math.floor(distance % (1000 * 60) / 1000);

      // Display the result in the respective elements
      $('.timer .days .time-count').text(days);
      $('.timer .hours .time-count').text(hours);
      $('.timer .minutes .time-count').text(minutes);
      $('.timer .seconds .time-count').text(seconds);
    }

    // Function to set a new target time
    function setNewTargetTime() {
      const newTargetTime = new Date().getTime() + 2.3 * 24 * 60 * 60 * 1000; // 2 days from now
      localStorage.setItem('dracula_offer_time', newTargetTime);
      targetTime = newTargetTime;
    }

    // Get or set the target time
    let targetTime = localStorage.getItem('dracula_offer_time');
    if (!targetTime || isNaN(targetTime)) {
      setNewTargetTime();
    } else {
      targetTime = parseInt(targetTime);
    }

    // Update the timer every second
    setInterval(updateTimer, 1000);
  }, []);
  useEffect(() => {
    if (!isOpen) {
      ReactDOM.unmountComponentAtNode(document.getElementById('dracula-pro-modal'));
    }
  }, [isOpen]);
  return isOpen ? (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "dracula-pro-modal-wrap"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "dracula-pro-modal"
  }, !!isDismissable && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "dracula-pro-modal-close",
    onClick: () => setIsOpen(false)
  }, "\xD7"), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("img", {
    src: `${dracula.pluginUrl}/assets/images/offer-box.png`,
    alt: "Upgrade to Pro"
  }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("h3", null, wp.i18n.__('Unlock PRO Features', 'dracula-dark-mode')), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", null, text), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "offer-discount"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("h4", null, wp.i18n.__('Special', 'dracula-dark-mode')), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", null, wp.i18n.__('30% OFF', 'dracula-dark-mode'))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "timer"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "days"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: 'time-count'
  }, "0"), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", null, wp.i18n.__('DAYS', 'dracula-dark-mode'))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "hours"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: 'time-count'
  }, "0"), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", null, wp.i18n.__('HOURS', 'dracula-dark-mode'))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "minutes"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: 'time-count'
  }, "0"), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", null, wp.i18n.__('MINUTES', 'dracula-dark-mode'))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "seconds"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: 'time-count'
  }, "0"), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", null, wp.i18n.__('SECONDS', 'dracula-dark-mode')))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "dracula-pro-modal-actions"
  }, !!watchVideo && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("a", {
    href: "#",
    className: "dracula-btn btn-success watch-video",
    onClick: e => {
      e.preventDefault();
      const videoSrc = `https://www.youtube.com/embed/${watchVideo.id}?autoplay=1&rel=0`;
      Swal.fire({
        title: watchVideo.title,
        html: `
                                                <div style="position:relative; padding-bottom:56.25%; overflow:hidden;">
                                                    <iframe 
                                                        src="${videoSrc}" 
                                                        frameborder="0" 
                                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" 
                                                        allowfullscreen
                                                        style="position:absolute; top:0; left:0; width:100%; height:100%;"
                                                    ></iframe>
                                                </div>
                                            `,
        showCloseButton: true,
        showConfirmButton: false,
        width: '70%',
        customClass: {
          container: 'dracula-swal dracula-pro-video-swal'
        }
      });
    }
  }, wp.i18n.__('Watch Video', 'dracula-dark-mode')), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("a", {
    href: dracula.upgradeUrl,
    className: "dracula-btn btn-primary"
  }, wp.i18n.__('Upgrade Now', 'dracula-dark-mode'))))) : null;
}
function showProModal(text = wp.i18n.__('Upgrade to PRO to unlock the feature.', 'dracula-dark-mode'), watchVideo) {
  let element = document.getElementById('dracula-pro-modal');
  if (!element) {
    element = document.createElement('div');
    element.id = 'dracula-pro-modal';
    document.body.appendChild(element);
  }
  ReactDOM.render((0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(ProModal, {
    text: text,
    watchVideo: watchVideo
  }), element);
}

/***/ }),

/***/ "../src/js/components/Settings/Toggles.js":
/*!************************************************!*\
  !*** ../src/js/components/Settings/Toggles.js ***!
  \************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ Toggles)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _ProModal__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../ProModal */ "../src/js/components/ProModal.js");
/* harmony import */ var _includes_functions__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../includes/functions */ "../src/js/includes/functions.js");



const {
  useState,
  useEffect
} = React;
function Toggles({
  value,
  onChange,
  attentionEffect
}) {
  const $ = window.jQuery;
  const {
    isPro,
    customToggles = []
  } = dracula;
  const [active, setActive] = useState(value);
  const [hoverItem, setHoverItem] = useState(null);

  // Render toggles
  useEffect(() => {
    (0,_includes_functions__WEBPACK_IMPORTED_MODULE_2__.initToggle)();
  }, []);

  // Handle toggle selection hover effect
  useEffect(() => {
    $(`.toggles .dracula-toggle`).removeClass('mode-dark');
    if (!hoverItem) return;
    $(`.toggles .toggle-wrap[data-style="${hoverItem}"] .dracula-toggle`).addClass('mode-dark');
  }, [hoverItem]);
  return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "toggles"
  }, [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18].map((style, index) => {
    const isActive = active == style;
    return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: `toggle-wrap dracula-ignore ${isActive ? 'active' : ''} ${!isPro && style > 2 ? 'disabled' : ''}`,
      key: index,
      onMouseEnter: () => {
        setHoverItem(style);
      },
      onMouseLeave: () => {
        setHoverItem(null);
      },
      onClick: () => {
        if (!isPro && style > 2) {
          (0,_ProModal__WEBPACK_IMPORTED_MODULE_1__.showProModal)(wp.i18n.__('This style is only available in the Pro version.', "dracula-dark-mode"));
          return;
        }
        setActive(style);
        onChange(style);
      },
      "data-style": style
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
      className: "index-label"
    }, style), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "dracula-toggle-wrap",
      "data-style": style
    }), !isPro && style > 2 && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
      className: "pro-label"
    }, wp.i18n.__("Pro", "dracula-dark-mode")), isActive && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("i", {
      className: "active-badge dashicons dashicons-saved"
    }));
  }), isPro && !!customToggles.length && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(react__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("h3", null, wp.i18n.__("Custom Toggles", "dracula-dark-mode")), customToggles.map(item => {
    const {
      id,
      title,
      config
    } = item;
    const data = btoa(JSON.stringify(config));
    const isActive = active == 'custom-' + id;
    return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      key: id,
      className: `toggle-wrap ${isActive ? 'active' : ''}`,
      onClick: () => {
        onChange('custom-' + id, config);
        setActive('custom-' + id);
      },
      onMouseEnter: () => {
        setHoverItem(id);
      },
      onMouseLeave: () => {
        setHoverItem(null);
      },
      "data-id": id
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
      className: "index-label"
    }, title), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "dracula-toggle-wrap custom-toggle",
      "data-id": id,
      "data-data": data
    }), isActive && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("i", {
      className: "active-badge dashicons dashicons-saved"
    }));
  })));
}

/***/ }),

/***/ "../src/js/includes/functions.js":
/*!***************************************!*\
  !*** ../src/js/includes/functions.js ***!
  \***************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   addDarkModeSelectorPrefix: () => (/* binding */ addDarkModeSelectorPrefix),
/* harmony export */   base64Decode: () => (/* binding */ base64Decode),
/* harmony export */   base64Encode: () => (/* binding */ base64Encode),
/* harmony export */   colorBrightness: () => (/* binding */ colorBrightness),
/* harmony export */   copyShortcode: () => (/* binding */ copyShortcode),
/* harmony export */   darkenBgImage: () => (/* binding */ darkenBgImage),
/* harmony export */   fixBackgroundColorAlpha: () => (/* binding */ fixBackgroundColorAlpha),
/* harmony export */   formatDate: () => (/* binding */ formatDate),
/* harmony export */   getColors: () => (/* binding */ getColors),
/* harmony export */   getConfig: () => (/* binding */ getConfig),
/* harmony export */   getCurrentCustomPresetColors: () => (/* binding */ getCurrentCustomPresetColors),
/* harmony export */   getExcludes: () => (/* binding */ getExcludes),
/* harmony export */   getIdParam: () => (/* binding */ getIdParam),
/* harmony export */   getPreset: () => (/* binding */ getPreset),
/* harmony export */   handleAnimation: () => (/* binding */ handleAnimation),
/* harmony export */   handleAttentionEffect: () => (/* binding */ handleAttentionEffect),
/* harmony export */   handleBackgroundOverlay: () => (/* binding */ handleBackgroundOverlay),
/* harmony export */   handleDraculaFont: () => (/* binding */ handleDraculaFont),
/* harmony export */   handleDraculaHides: () => (/* binding */ handleDraculaHides),
/* harmony export */   handleDraggableToggle: () => (/* binding */ handleDraggableToggle),
/* harmony export */   handleImageBehaviour: () => (/* binding */ handleImageBehaviour),
/* harmony export */   handleReadingProgress: () => (/* binding */ handleReadingProgress),
/* harmony export */   handleVideoBehaviour: () => (/* binding */ handleVideoBehaviour),
/* harmony export */   hexToRgba: () => (/* binding */ hexToRgba),
/* harmony export */   imageReplacements: () => (/* binding */ imageReplacements),
/* harmony export */   initToggle: () => (/* binding */ initToggle),
/* harmony export */   invertInlineSvg: () => (/* binding */ invertInlineSvg),
/* harmony export */   isVisible: () => (/* binding */ isVisible),
/* harmony export */   lightenDarkenColor: () => (/* binding */ lightenDarkenColor),
/* harmony export */   promptFeedback: () => (/* binding */ promptFeedback),
/* harmony export */   reloadDisqus: () => (/* binding */ reloadDisqus),
/* harmony export */   removeIdParam: () => (/* binding */ removeIdParam),
/* harmony export */   saveSettings: () => (/* binding */ saveSettings),
/* harmony export */   setIdParam: () => (/* binding */ setIdParam),
/* harmony export */   showReviewPopup: () => (/* binding */ showReviewPopup),
/* harmony export */   timeAgo: () => (/* binding */ timeAgo),
/* harmony export */   useMounted: () => (/* binding */ useMounted),
/* harmony export */   videoReplacements: () => (/* binding */ videoReplacements)
/* harmony export */ });
function useMounted() {
  const [mounted, setMounted] = React.useState(false);
  React.useEffect(() => {
    setMounted(true);
  }, []);
  return mounted;
}
function getExcludes(excludes) {
  const defaultExcludes = ['.dracula-ignore'];
  if (typeof excludes === 'undefined') {
    excludes = dracula.settings.excludes;
  }
  if (excludes) {
    excludes = excludes.filter(function (el) {
      return el != '';
    });
    return defaultExcludes.concat(excludes);
  }
  return defaultExcludes;
}
function getConfig(data = dracula.settings) {
  const {
    darkToLight,
    colorMode = 'dynamic',
    preset = 'default',
    activeCustomPreset,
    customPresets,
    brightness = 100,
    contrast = 90,
    sepia = 10,
    grayscale = 0,
    changeFont,
    fontFamily,
    excludes,
    textStroke = 0,
    darkenBackgroundImages = true,
    scrollbarDarkMode = 'auto',
    scrollbarColor = '#181a1b'
  } = data;
  const config = {
    mode: !!darkToLight ? 0 : 1,
    brightness,
    contrast,
    sepia,
    grayscale,
    excludes: getExcludes(excludes),
    darkenBackgroundImages
  };
  const presetColors = getColors({
    colorMode,
    preset,
    activeCustomPreset,
    customPresets
  });
  config.darkSchemeBackgroundColor = presetColors.bg;
  config.darkSchemeTextColor = presetColors.text;
  config.lightSchemeBackgroundColor = presetColors.bg;
  config.lightSchemeTextColor = presetColors.text;
  if (changeFont) {
    config.useFont = changeFont;
    config.textStroke = textStroke;
    if (fontFamily) {
      config.fontFamily = fontFamily;
      const fontName = fontFamily.replace(/'/g, '');
      const match = fontName.match(/^[^,]+/);
      if (match) {
        const fontLink = document.querySelector('#dracula-font-link');
        if (!fontLink) {
          const link = document.createElement('link');
          link.id = 'dracula-font-link';
          link.href = `https://fonts.googleapis.com/css?family=${match[0].replace(/ /g, '+')}`;
          link.rel = 'stylesheet';
          document.head.appendChild(link);
        }
      }
    }
  }

  // Scrollbar Color
  if (scrollbarDarkMode === 'custom') {
    config.scrollbarColor = scrollbarColor;
  } else if (scrollbarDarkMode === 'auto') {
    config.scrollbarColor = 'auto';
  } else if (scrollbarDarkMode === 'disabled') {
    config.scrollbarColor = '';
  } else {
    config.scrollbarColor = '';
  }
  return config;
}
function saveSettings(data, showConfirmation = true) {
  return wp.ajax.post(`dracula_save_settings`, {
    data: base64Encode(JSON.stringify(data)),
    nonce: dracula.nonce
  }).done(() => {
    if (showConfirmation) {
      Swal.fire({
        title: false,
        text: wp.i18n.__('Settings saved successfully.', 'dracula-dark-mode'),
        icon: 'success',
        toast: true,
        timer: 2000,
        timerProgressBar: true,
        showConfirmButton: false,
        position: 'top-end',
        customClass: {
          container: 'dracula-swal save-settings-toast dracula-ignore '
        }
      });
    }
  });
}
function lightenDarkenColor(col, amt) {
  let usePound = false;
  if (col[0] == "#") {
    col = col.slice(1);
    usePound = true;
  }
  let num = parseInt(col, 16);
  let r = (num >> 16) + amt;
  if (r > 255) r = 255;else if (r < 0) r = 0;
  let b = (num >> 8 & 0x00FF) + amt;
  if (b > 255) b = 255;else if (b < 0) b = 0;
  let g = (num & 0x0000FF) + amt;
  if (g > 255) g = 255;else if (g < 0) g = 0;
  return (usePound ? "#" : "") + (g | b << 8 | r << 16).toString(16);
}
function getPreset(key = null) {
  const presets = [
  // --- Neutrals / Editors ---
  {
    key: 'default',
    label: 'Default',
    colors: {
      bg: '#181a1b',
      text: '#e8e6e3',
      secondary_bg: '#202324',
      link: '#6ea5d9',
      link_hover: '#88b9e3',
      btn_bg: '#3b6f99',
      btn_text: '#dcdcdc',
      btn_text_hover: '#f0f0f0',
      btn_hover_bg: '#325d80',
      input_text: '#e8e6e3',
      input_bg: '#1f2223',
      input_placeholder: '#8c8c8c',
      border: '#2d2d2d'
    }
  }, {
    key: 'dracula',
    label: 'Dracula',
    colors: {
      bg: '#282b36',
      text: '#e8e6e3',
      secondary_bg: '#343746',
      link: '#9a87cc',
      link_hover: '#b79ce2',
      btn_bg: '#5a6288',
      btn_text: '#dedede',
      btn_text_hover: '#f0f0f0',
      btn_hover_bg: '#4b5274',
      input_text: '#e8e6e3',
      input_bg: '#3a3c4e',
      input_placeholder: '#8b8b9c',
      border: '#45475a'
    }
  }, {
    key: 'catppuccin',
    label: 'Catppuccin',
    colors: {
      bg: '#161320',
      text: '#d9e0ee',
      secondary_bg: '#1e1a2e',
      link: '#b69ad8',
      link_hover: '#c5b0e1',
      btn_bg: '#8a74b8',
      btn_text: '#d9e0ee',
      btn_text_hover: '#ffffff',
      btn_hover_bg: '#7a66a3',
      input_text: '#d9e0ee',
      input_bg: '#1e1a2e',
      input_placeholder: '#8e89a3',
      border: '#2a2438'
    }
  }, {
    key: 'gruvbox',
    label: 'Gruvbox',
    colors: {
      bg: '#282828',
      text: '#ebdbb2',
      secondary_bg: '#32302f',
      link: '#d4a73c',
      link_hover: '#e0b252',
      btn_bg: '#a97e2c',
      btn_text: '#ebdbb2',
      btn_text_hover: '#ffffff',
      btn_hover_bg: '#8f6a25',
      input_text: '#ebdbb2',
      input_bg: '#32302f',
      input_placeholder: '#a89984',
      border: '#504945'
    }
  }, {
    key: 'nord',
    label: 'Nord',
    colors: {
      bg: '#2e3440',
      text: '#eceff4',
      secondary_bg: '#3b4252',
      link: '#88c0d0',
      link_hover: '#a3d1dc',
      btn_bg: '#5e81ac',
      btn_text: '#eceff4',
      btn_text_hover: '#ffffff',
      btn_hover_bg: '#4c6a92',
      input_text: '#eceff4',
      input_bg: '#434c5e',
      input_placeholder: '#9aa0a6',
      border: '#4c566a'
    }
  }, {
    key: 'rosePine',
    label: 'Rose Pine',
    colors: {
      bg: '#191724',
      text: '#e0def4',
      secondary_bg: '#1f1d2e',
      link: '#d2879d',
      link_hover: '#e2a3b7',
      btn_bg: '#6d879c',
      btn_text: '#e0def4',
      btn_text_hover: '#ffffff',
      btn_hover_bg: '#5a6f81',
      input_text: '#e0def4',
      input_bg: '#26233a',
      input_placeholder: '#908caa',
      border: '#524f67'
    }
  }, {
    key: 'solarized',
    label: 'Solarized',
    colors: {
      bg: '#002b36',
      text: '#93a1a1',
      secondary_bg: '#073642',
      link: '#6aa6a6',
      link_hover: '#82bcbc',
      btn_bg: '#2f5f66',
      btn_text: '#cfe3e3',
      btn_text_hover: '#e6f0f0',
      btn_hover_bg: '#2a5359',
      input_text: '#a7b6b6',
      input_bg: '#0d3944',
      input_placeholder: '#6f8383',
      border: '#0f3a44'
    }
  }, {
    key: 'tokyoNight',
    label: 'Tokyo Night',
    colors: {
      bg: '#1a1b26',
      text: '#a9b1d6',
      secondary_bg: '#1f2230',
      link: '#7aa2f7',
      link_hover: '#8fb5ff',
      btn_bg: '#3b4a7a',
      btn_text: '#cfd6f2',
      btn_text_hover: '#ffffff',
      btn_hover_bg: '#323f68',
      input_text: '#b7bfe1',
      input_bg: '#212335',
      input_placeholder: '#7c85a9',
      border: '#2a2e42'
    }
  }, {
    key: 'monokai',
    label: 'Monokai',
    colors: {
      bg: '#272822',
      text: '#f8f8f2',
      secondary_bg: '#2f302a',
      link: '#8fc66a',
      link_hover: '#a1d57a',
      btn_bg: '#5b6e4a',
      btn_text: '#e6f1dd',
      btn_text_hover: '#ffffff',
      btn_hover_bg: '#4d5e3f',
      input_text: '#efeede',
      input_bg: '#303126',
      input_placeholder: '#9aa08f',
      border: '#3a3b33'
    }
  }, {
    key: 'ayuMirage',
    label: 'Ayu Mirage',
    colors: {
      bg: '#1f2430',
      text: '#cbccc6',
      secondary_bg: '#252b39',
      link: '#9ccfd8',
      link_hover: '#b7e0e6',
      btn_bg: '#5f7890',
      btn_text: '#dfe2e0',
      btn_text_hover: '#ffffff',
      btn_hover_bg: '#50677d',
      input_text: '#d5d6d0',
      input_bg: '#262d3b',
      input_placeholder: '#8d94a1',
      border: '#2c3443'
    }
  }, {
    key: 'ayuDark',
    label: 'Ayu Dark',
    colors: {
      bg: '#0a0e14',
      text: '#b3b1ad',
      secondary_bg: '#121721',
      link: '#5aa7c8',
      link_hover: '#72b8d5',
      btn_bg: '#3a6075',
      btn_text: '#cfd6da',
      btn_text_hover: '#e7eef2',
      btn_hover_bg: '#314f61',
      input_text: '#c2c0bc',
      input_bg: '#121722',
      input_placeholder: '#808693',
      border: '#1b2230'
    }
  }, {
    key: 'material',
    label: 'Material',
    colors: {
      bg: '#263238',
      text: '#eceff1',
      secondary_bg: '#2e3b41',
      link: '#82b1ff',
      link_hover: '#9bbfff',
      btn_bg: '#546e7a',
      btn_text: '#e6eff3',
      btn_text_hover: '#ffffff',
      btn_hover_bg: '#465c65',
      input_text: '#e4eaee',
      input_bg: '#2b3940',
      input_placeholder: '#9aaab1',
      border: '#31434a'
    }
  }, {
    key: 'oneDark',
    label: 'One Dark',
    colors: {
      bg: '#282c34',
      text: '#abb2bf',
      secondary_bg: '#2f3440',
      link: '#6fb4f0',
      link_hover: '#89c2f4',
      btn_bg: '#3d5872',
      btn_text: '#cfd6e2',
      btn_text_hover: '#eaf1fb',
      btn_hover_bg: '#334a60',
      input_text: '#b9c0cd',
      input_bg: '#2c303a',
      input_placeholder: '#8a909c',
      border: '#3a3f4a'
    }
  }, {
    key: 'oceanicNext',
    label: 'Oceanic Next',
    colors: {
      bg: '#1B2B34',
      text: '#CDD3DE',
      secondary_bg: '#203340',
      link: '#5fb3b3',
      link_hover: '#77c4c4',
      btn_bg: '#3f6d6d',
      btn_text: '#d8e4e4',
      btn_text_hover: '#f0f7f7',
      btn_hover_bg: '#355c5c',
      input_text: '#d2d8e1',
      input_bg: '#223746',
      input_placeholder: '#8ca1ad',
      border: '#2a4050'
    }
  }, {
    key: 'cityLights',
    label: 'City Lights',
    colors: {
      bg: '#1d252c',
      text: '#b6bfc4',
      secondary_bg: '#232c34',
      link: '#76a8d9',
      link_hover: '#8bb9e3',
      btn_bg: '#3e5f7a',
      btn_text: '#d4dde2',
      btn_text_hover: '#f0f6fb',
      btn_hover_bg: '#344f66',
      input_text: '#c2cbd0',
      input_bg: '#232c34',
      input_placeholder: '#8b97a0',
      border: '#2a343e'
    }
  }, {
    key: 'nightOwl',
    label: 'Night Owl',
    colors: {
      bg: '#011627',
      text: '#d6deeb',
      secondary_bg: '#071d33',
      link: '#82aaff',
      link_hover: '#9bb6ff',
      btn_bg: '#425b8a',
      btn_text: '#e4ecfa',
      btn_text_hover: '#ffffff',
      btn_hover_bg: '#394f78',
      input_text: '#dbe3f0',
      input_bg: '#0a1f36',
      input_placeholder: '#8aa0be',
      border: '#0f2740'
    }
  },
  // --- Sites ---
  {
    key: 'youtube',
    label: 'YouTube',
    colors: {
      bg: '#181818',
      text: '#ffffff',
      secondary_bg: '#202020',
      link: '#e05a5a',
      link_hover: '#ff6b6b',
      btn_bg: '#8a2b2b',
      btn_text: '#f2f2f2',
      btn_text_hover: '#ffffff',
      btn_hover_bg: '#722424',
      input_text: '#f0f0f0',
      input_bg: '#222222',
      input_placeholder: '#9a9a9a',
      border: '#2a2a2a'
    }
  }, {
    key: 'twitter',
    label: 'Twitter',
    colors: {
      bg: '#15202b',
      text: '#ffffff',
      secondary_bg: '#1b2733',
      link: '#69b3ff',
      link_hover: '#8cc6ff',
      btn_bg: '#3a6fa1',
      btn_text: '#e8f3ff',
      btn_text_hover: '#ffffff',
      btn_hover_bg: '#325f8a',
      input_text: '#eef6ff',
      input_bg: '#1e2a36',
      input_placeholder: '#8ea5bd',
      border: '#263544'
    }
  }, {
    key: 'reddit',
    label: 'Reddit (Night mode)',
    colors: {
      bg: '#1a1a1b',
      text: '#d7dadc',
      secondary_bg: '#202021',
      link: '#ff9566',
      link_hover: '#ffb187',
      btn_bg: '#7a4a2e',
      btn_text: '#efd9cf',
      btn_text_hover: '#ffffff',
      btn_hover_bg: '#693f27',
      input_text: '#e3e6e8',
      input_bg: '#222223',
      input_placeholder: '#9aa0a3',
      border: '#2a2a2b'
    }
  }, {
    key: 'discord',
    label: 'Discord',
    colors: {
      bg: '#36393f',
      text: '#dcddde',
      secondary_bg: '#3c4047',
      link: '#8ea1e1',
      link_hover: '#a5b3ea',
      btn_bg: '#4957d6',
      btn_text: '#e7e9ff',
      btn_text_hover: '#ffffff',
      btn_hover_bg: '#3f4bc0',
      input_text: '#e3e4e6',
      input_bg: '#40444b',
      input_placeholder: '#9aa1ae',
      border: '#454a52'
    }
  }, {
    key: 'slack',
    label: 'Slack',
    colors: {
      bg: '#1d1c1d',
      text: '#e7e7e7',
      secondary_bg: '#232223',
      link: '#cf8fb6',
      link_hover: '#dda6c5',
      btn_bg: '#6b5a6e',
      btn_text: '#efe3ef',
      btn_text_hover: '#ffffff',
      btn_hover_bg: '#5b4d5d',
      input_text: '#ededed',
      input_bg: '#242324',
      input_placeholder: '#9a969b',
      border: '#2a292a'
    }
  }, {
    key: 'whatsapp',
    label: 'WhatsApp',
    colors: {
      bg: '#121212',
      text: '#e6e5e4',
      secondary_bg: '#161616',
      link: '#67b97a',
      link_hover: '#7acc8d',
      btn_bg: '#2f6b3e',
      btn_text: '#d8f0df',
      btn_text_hover: '#f2fff6',
      btn_hover_bg: '#285b35',
      input_text: '#ecebe9',
      input_bg: '#1a1a1a',
      input_placeholder: '#8d8d8d',
      border: '#222222'
    }
  }, {
    key: 'github',
    label: 'GitHub',
    colors: {
      bg: '#0d1117',
      text: '#c9d1d9',
      secondary_bg: '#11161e',
      link: '#6aa6ff',
      link_hover: '#8abaff',
      btn_bg: '#2f3a4a',
      btn_text: '#d8e2ec',
      btn_text_hover: '#ffffff',
      btn_hover_bg: '#26303d',
      input_text: '#d3dbe2',
      input_bg: '#0f1420',
      input_placeholder: '#8894a1',
      border: '#1a2230'
    }
  }, {
    key: 'stackoverflow',
    label: 'StackOverflow',
    colors: {
      bg: '#2d2d2d',
      text: '#f2f2f2',
      secondary_bg: '#333333',
      link: '#ffa654',
      link_hover: '#ffbb7a',
      btn_bg: '#7a4e1f',
      btn_text: '#fdeedd',
      btn_text_hover: '#ffffff',
      btn_hover_bg: '#683f18',
      input_text: '#f0f0f0',
      input_bg: '#353535',
      input_placeholder: '#9a9a9a',
      border: '#3c3c3c'
    }
  }];
  if (key !== null) {
    const preset = presets.find(p => p.key === key);
    if (preset) return preset;
  }
  return presets;
}
function getCurrentCustomPresetColors(activeCustomPreset, customPresets) {
  const index = customPresets.findIndex(p => p?.id === activeCustomPreset);
  const currentCustomPreset = customPresets[index] || {};
  const colors = {
    ...(currentCustomPreset.colors || {})
  };
  if (colors.bg) {
    colors.secondary_bg = lightenDarkenColor(colors.bg, 10);
  }
  if (colors.link) {
    colors.link_hover = lightenDarkenColor(colors.link, -40);
  }
  if (colors.btn_bg) {
    colors.btn_hover_bg = lightenDarkenColor(colors.btn_bg, -10);
  }
  if (colors.btn_text) {
    colors.btn_text_hover = lightenDarkenColor(colors.btn_text, 20);
  }
  if (colors.input_text) {
    colors.input_placeholder = lightenDarkenColor(colors.input_text, 10);
  }
  return colors;
}

/**
 * Get colors for dark mode, based on the current color mode and preset
 *
 * @returns {{bg: string, text: string, secondary_bg: string, link: string, link_hover: string, btn_bg: string, btn_text: string, btn_text_hover: string, btn_hover_bg: string, input_text: string, input_bg: string, input_placeholder: string, border: string}}
 */
function getColors({
  colorMode = 'dynamic',
  preset = '1',
  activeCustomPreset = null,
  customPresets = []
}) {
  let colors = {
    bg: '#181a1b',
    text: '#e8e6e3',
    secondary_bg: '#202324',
    link: '#6ea5d9',
    link_hover: '#88b9e3',
    btn_bg: '#3b6f99',
    btn_text: '#dcdcdc',
    btn_text_hover: '#f0f0f0',
    btn_hover_bg: '#325d80',
    input_text: '#e8e6e3',
    input_bg: '#1f2223',
    input_placeholder: '#8c8c8c',
    border: '#2d2d2d'
  };
  if ('presets' === colorMode) {
    const presetConfig = dracula.presets.find(p => p.key === preset);
    colors = presetConfig.colors;
  } else if ('custom' === colorMode) {
    colors = getCurrentCustomPresetColors(activeCustomPreset, customPresets);
  }
  return colors;
}
function copyShortcode(e) {
  const element = e.target.parentNode.querySelector('code');
  window.getSelection().selectAllChildren(element);
  const copyText = element.innerHTML;
  if (window.isSecureContext) {
    navigator.clipboard.writeText(copyText);
  } else {
    const textArea = document.createElement("textarea");
    textArea.value = copyText;
    document.body.appendChild(textArea);
    textArea.select();
    document.execCommand("Copy");
    textArea.remove();
  }
  Swal.fire({
    title: wp.i18n.__('Copied', "dracula-dark-mode"),
    text: wp.i18n.__('Shortcode copied to clipboard', "dracula-dark-mode"),
    icon: 'success',
    showConfirmButton: false,
    timer: 2000,
    timerProgressBar: true,
    toast: true
  });
}

/**
 * Replace images with dark version
 * isReset is used for liveEdit
 *
 * @param images
 * @param isReset
 */

function imageReplacements(images = dracula.settings.images, isReset = false) {
  const $ = jQuery;
  const isDarkMode = window.draculaDarkMode.isEnabled();
  function restoreImages() {
    const imageUpdates = [];
    const sourceUpdates = [];
    const bgImageUpdates = [];
    $('[data-dracula-src]').each((_, element) => {
      imageUpdates.push(() => {
        $(element).attr({
          'src': element.dataset.draculaSrc,
          'srcset': element.dataset.draculaSrcset
        });
        $(element).removeAttr('data-dracula-src data-dracula-srcset');
      });
    });
    $('source[data-dracula-srcset]').each((_, element) => {
      sourceUpdates.push(() => {
        $(element).attr('srcset', element.dataset.draculaSrcset);
        $(element).removeAttr('data-dracula-srcset');
      });
    });
    $('[data-dracula-bg-image]').each((_, element) => {
      const bgImage = $(element).attr('data-dracula-bg-image');
      bgImageUpdates.push(() => {
        $(element).css('background-image', bgImage);
        $(element).removeAttr('data-dracula-bg-image');
      });
    });
    imageUpdates.forEach(fn => fn());
    sourceUpdates.forEach(fn => fn());
    bgImageUpdates.forEach(fn => fn());
  }
  if (!images || !images.length) {
    restoreImages();
    return;
  }
  const imageMap = new Map(images.map(image => [image.light, image.dark]));
  const replaceImages = () => {
    const imageUpdates = [];
    const sourceUpdates = [];
    const bgImageUpdates = [];

    // for pro
    if (!!dracula.isPro) {
      images.forEach(image => {
        const {
          light: lightSrc,
          dark: darkSrc
        } = image;
        if (lightSrc && darkSrc) {
          $(`img[src*="${lightSrc}"]`).each((_, element) => {
            imageUpdates.push(() => {
              $(element).attr({
                'data-dracula-src': element.src,
                'data-dracula-srcset': element.srcset,
                'src': darkSrc,
                'srcset': darkSrc
              });
            });
          });
          $(`source[srcset*="${lightSrc}"]`).each((_, element) => {
            sourceUpdates.push(() => {
              $(element).attr({
                'data-dracula-srcset': element.srcset,
                'srcset': darkSrc
              });
            });
          });
        }
      });
    } else {
      // Only process the first item
      if (images.length > 0) {
        const image = images[0];
        const {
          light: lightSrc,
          dark: darkSrc
        } = image;
        if (lightSrc && darkSrc) {
          $(`img[src="${lightSrc}"]`).each((_, element) => {
            imageUpdates.push(() => {
              $(element).attr({
                'data-dracula-src': element.src,
                'data-dracula-srcset': element.srcset,
                'src': darkSrc,
                'srcset': darkSrc
              });
            });
          });
          $(`source[srcset*="${lightSrc}"]`).each((_, element) => {
            sourceUpdates.push(() => {
              $(element).attr({
                'data-dracula-srcset': element.srcset,
                'srcset': darkSrc
              });
            });
          });
        }
      }
    }
    $('body, div, header, footer, section, article, aside, main, figure, aside').each((_, element) => {
      const $element = $(element);
      const bgImage = $element.css('background-image');
      if ('none' === bgImage) return;
      const url = bgImage.replace(/linear-gradient\(.*?\),\s*url\((['"])?(.*?)\1\)/gi, '$2').split(',')[0];
      if (!url || url.includes('data:image')) return;
      const darkImage = imageMap.get(url);
      if (darkImage) {
        bgImageUpdates.push(() => {
          $element.css('background-image', bgImage.replace(url, darkImage));
          $element.attr('data-dracula-bg-image', bgImage);
        });
      }
    });
    imageUpdates.forEach(fn => fn());
    sourceUpdates.forEach(fn => fn());
    bgImageUpdates.forEach(fn => fn());
  };
  if (!isDarkMode || isReset) {
    restoreImages();
    if (isReset) replaceImages();
  } else {
    replaceImages();
  }
}
function videoReplacements(videos = dracula.settings.videos, isReset = false) {
  const $ = jQuery;
  const isDarkMode = draculaDarkMode.isEnabled();
  const platforms = {
    youtube: /^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/,
    vimeo: /^(?:https?:\/\/)?(?:www\.)?(?:vimeo\.com\/)([0-9]+)$/,
    dailymotion: /(?:https?:\/\/)?(?:www\.)?dai\.?ly(motion)?(?:\.com)?\/?.*(?:video|embed)?(?:.*v=|v\/|\/)([a-z0-9]+)/i
  };
  function restoreElementSrc($elements) {
    $elements.each((_, el) => $(el).attr('src', el.dataset.draculaSrc));
  }
  function replaceSrc($elements, lightId, darkId) {
    $elements.each((_, el) => $(el).attr({
      'data-dracula-src': el.src,
      'src': el.src.replace(lightId, darkId)
    }));
  }
  if (!videos?.length) {
    restoreElementSrc($('iframe[data-dracula-src], video[data-dracula-src]'));
    return;
  }
  function replaceVideos() {
    videos.forEach(({
      light: lightSrc,
      dark: darkSrc
    }) => {
      if (!lightSrc || !darkSrc) return;
      for (const [platform, regex] of Object.entries(platforms)) {
        const lightMatch = lightSrc.match(regex);
        const darkMatch = darkSrc.match(regex);
        if (lightMatch && darkMatch) {
          const lightId = lightMatch[1]; // Update this line to get the correct group
          const darkId = darkMatch[1]; // Update this line to get the correct group
          replaceSrc($(`iframe[src*="${lightId}"], video[src*="${lightId}"]`), lightId, darkId);
          return; // Exit the loop
        }
      }

      // Fallback for non-matching platforms
      replaceSrc($(`video[src*="${lightSrc}"]`), lightSrc, darkSrc);
    });
  }
  if (!isDarkMode || isReset) {
    restoreElementSrc($('iframe[data-dracula-src], video[data-dracula-src]'));
    if (isReset) {
      replaceVideos();
    }
  } else {
    replaceVideos();
  }
}
function base64Encode(str) {
  return btoa(encodeURIComponent(str).replace(/%([0-9A-F]{2})/g, function toSolidBytes(match, p1) {
    return String.fromCharCode('0x' + p1);
  }));
}
function base64Decode(str) {
  return decodeURIComponent(atob(str).split('').map(function (c) {
    return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
  }).join(''));
}
function formatDate(date, includeTime = false) {
  date = new Date(date);
  const year = date.getFullYear();
  const month = ('0' + (date.getMonth() + 1)).slice(-2); // Add 1 because getMonth() starts at 0
  const day = ('0' + date.getDate()).slice(-2);
  if (includeTime) {
    const hour24 = date.getHours();
    const amPm = hour24 < 12 ? 'AM' : 'PM';
    const hour12 = hour24 === 0 ? 12 : hour24 > 12 ? hour24 - 12 : hour24; // Convert to 12-hour format
    const minutes = ('0' + date.getMinutes()).slice(-2);
    return `${year}-${month}-${day} ${('0' + hour12).slice(-2)}:${minutes} ${amPm}`;
  } else {
    return `${year}-${month}-${day}`;
  }
}
function timeAgo(date) {
  const now = new Date();
  const diff = Math.abs(now - new Date(date));
  const days = Math.floor(diff / (1000 * 60 * 60 * 24));
  if (days > 7) {
    return formatDate(date);
  } else {
    const hours = Math.floor(diff / (1000 * 60 * 60));
    const minutes = Math.floor(diff / (1000 * 60));
    if (days > 0) {
      return days + ' day' + (days > 1 ? 's' : '') + ' ago';
    } else if (hours > 0) {
      return hours + ' hour' + (hours > 1 ? 's' : '') + ' ago';
    } else {
      return minutes + ' minute' + (minutes > 1 ? 's' : '') + ' ago';
    }
  }
}
function setIdParam(id) {
  const url = new URL(window.location.href);
  url.searchParams.set('id', id);
  window.history.pushState({}, '', url);
}
function removeIdParam() {
  const url = new URL(window.location.href);
  url.searchParams.delete('id');
  window.history.pushState({}, '', url);
}
function getIdParam() {
  const params = new URLSearchParams(window.location.search);
  const id = params.get('id');
  return id;
}
function handleAnimation(mode = 'dark', selector = '', pageTransition = 'none') {
  // check pro
  if (!dracula.isPro) return;
  if (!selector) {
    selector = 'body > main, body > header, body > div:not(.dracula-toggle-wrap):not(.dracula-ignore), body > footer, body > section';
  }
  const isDarkMode = typeof draculaDarkMode?.isEnabled === 'function' ? draculaDarkMode?.isEnabled() : mode === 'dark';
  if ('fade' === pageTransition) {
    // Fade
    document.querySelectorAll(selector).forEach(el => {
      el.style.opacity = 0;
      el.style.transition = 'none';
      void el.offsetHeight;
      el.style.transition = 'opacity 1s ease';
      requestAnimationFrame(() => {
        el.style.opacity = 1;
      });
    });
  } else if ('slide' === pageTransition) {
    // Slide
    document.querySelectorAll(selector).forEach(el => {
      el.style.transform = `translateX(${isDarkMode ? '-100%' : '100%'})`;
      el.style.transition = 'none';
      void el.offsetHeight;
      el.style.transition = 'transform 1s ease';
      requestAnimationFrame(() => {
        el.style.transform = 'translateX(0%)';
      });
    });
  } else if ('zoom' === pageTransition) {
    // Zoom
    document.querySelectorAll(selector).forEach(el => {
      el.style.transform = `scale(${isDarkMode ? 1.05 : 0.95})`;
      el.style.transition = 'none';
      void el.offsetHeight;
      el.style.transition = 'transform 1s ease';
      requestAnimationFrame(() => {
        el.style.transform = 'scale(1)';
      });
    });
  } else if ('rotate' === pageTransition) {
    // Rotate
    document.querySelectorAll(selector).forEach(el => {
      el.style.transform = `rotate(${isDarkMode ? -7 : 7}deg)`;
      el.style.transition = 'none';
      void el.offsetHeight;
      el.style.transition = 'transform 1s ease';
      requestAnimationFrame(() => {
        el.style.transform = 'rotate(0deg)';
      });
    });
  } else if ('flip' === pageTransition) {
    // Flip
    document.querySelectorAll(selector).forEach(el => {
      el.style.transformStyle = 'preserve-3d';
      el.style.backfaceVisibility = 'hidden';
      el.style.transform = `rotateY(${isDarkMode ? 50 : -50}deg)`;
      el.style.transition = 'none';
      void el.offsetHeight;
      el.style.transition = 'transform 1s ease';
      requestAnimationFrame(() => {
        el.style.transform = 'rotateY(0deg)';
      });
    });
  } else if ('cube' === pageTransition) {
    // 3D Cube
    document.querySelectorAll(selector).forEach(el => {
      el.style.transformStyle = 'preserve-3d';
      el.style.backfaceVisibility = 'hidden';
      if (el.parentElement) {
        el.parentElement.style.perspective = '1500px';
      }
      el.style.transform = `rotateX(${isDarkMode ? 5 : -5}deg)`;
      el.style.transition = 'none';
      void el.offsetHeight;
      el.style.transition = 'transform 1s ease';
      requestAnimationFrame(() => {
        el.style.transform = 'rotateX(0deg)';
      });
    });
  } else if ('scale-fade' === pageTransition) {
    // Scale and Fade
    document.querySelectorAll(selector).forEach(el => {
      el.style.transform = `scale(${isDarkMode ? 0.95 : 1.05})`;
      el.style.opacity = '0';
      el.style.transition = 'none';
      void el.offsetHeight;
      el.style.transition = 'transform 1s ease, opacity 1s ease';
      requestAnimationFrame(() => {
        el.style.transform = 'scale(1)';
        el.style.opacity = '1';
      });
    });
  } else if ('skew' === pageTransition) {
    // Skew
    document.querySelectorAll(selector).forEach(el => {
      el.style.transform = `skewX(${isDarkMode ? 15 : -15}deg)`;
      el.style.transition = 'none';
      void el.offsetHeight;
      el.style.transition = 'transform 1s ease';
      requestAnimationFrame(() => {
        el.style.transform = 'skewX(0deg)';
      });
    });
  } else if ('bounce' === pageTransition) {
    // Bounce
    document.querySelectorAll(selector).forEach(el => {
      el.style.transition = 'none';
      el.style.transform = `translateY(${isDarkMode ? '-10%' : '10%'})`;
      el.style.opacity = '1';
      void el.offsetHeight;
      el.animate([{
        transform: `translateY(${isDarkMode ? '-10%' : '10%'})`
      }, {
        transform: 'translateY(0%)'
      }, {
        transform: 'translateY(-4%)'
      }, {
        transform: 'translateY(0%)'
      }, {
        transform: 'translateY(-2%)'
      }, {
        transform: 'translateY(0%)'
      }], {
        duration: 1000,
        easing: 'ease-out',
        fill: 'forwards'
      });
    });
  } else if ('blur' === pageTransition) {
    // Blur
    document.querySelectorAll(selector).forEach(el => {
      el.style.filter = 'blur(3px)';
      el.style.transition = 'none';
      void el.offsetHeight;
      el.style.transition = 'filter 1s ease';
      requestAnimationFrame(() => {
        el.style.filter = 'blur(0px)';
      });
    });
  } else if ('squeeze' === pageTransition) {
    // Squeeze
    document.querySelectorAll(selector).forEach(el => {
      el.style.transformOrigin = 'left center';
      el.style.transform = `scaleX(${isDarkMode ? 0.95 : 1.05})`;
      el.style.transition = 'none';
      void el.offsetHeight;
      el.style.transition = 'transform 1s ease';
      requestAnimationFrame(() => {
        el.style.transform = 'scaleX(1)';
      });
    });
  } else if ('curtain' === pageTransition) {
    // Curtain
    document.querySelectorAll(selector).forEach(el => {
      el.style.clipPath = isDarkMode ? 'polygon(0% 100%, 100% 100%, 100% 100%, 0% 100%)' : 'polygon(0% 0%, 100% 0%, 100% 0%, 0% 0%)';
      el.style.transition = 'none';
      void el.offsetHeight;
      el.style.transition = 'clip-path 1s ease';
      requestAnimationFrame(() => {
        el.style.clipPath = 'polygon(0% 0%, 100% 0%, 100% 100%, 0% 100%)';
      });
    });
  } else if ('push' === pageTransition) {
    // Push
    document.querySelectorAll(selector).forEach(el => {
      el.style.transform = `translateX(${isDarkMode ? '-100%' : '100%'})`;
      el.style.transition = 'none';
      void el.offsetHeight;
      el.style.transition = 'transform 1s ease';
      requestAnimationFrame(() => {
        el.style.transform = 'translateX(0%)';
      });
    });
  } else if ('twist' === pageTransition) {
    // Twist
    document.querySelectorAll(selector).forEach(el => {
      el.style.transform = `rotate(${isDarkMode ? -15 : 15}deg) scale(0.9)`;
      el.style.transition = 'none';
      void el.offsetHeight;
      el.style.transition = 'transform 1s ease';
      requestAnimationFrame(() => {
        el.style.transform = 'rotate(0deg) scale(1)';
      });
    });
  } else if ('wave' === pageTransition) {
    document.querySelectorAll(selector).forEach(el => {
      const startY = isDarkMode ? -10 : 10;
      el.animate([{
        transform: `translateY(${startY}px)`
      }, {
        transform: 'translateY(0px)'
      }], {
        duration: 1000,
        easing: 'ease-in-out',
        direction: 'alternate',
        iterations: 3
      });
    });
  }
}
function promptFeedback() {
  Swal.fire({
    title: 'How do you feel about our Dark Mode experience?',
    icon: 'question',
    input: 'textarea',
    showCancelButton: true,
    confirmButtonText: 'Submit',
    reverseButtons: true,
    customClass: {
      container: 'dracula-swal dracula-feedback-swal'
    }
  }).then(textResult => {
    if (textResult.value) {
      const message = textResult.value;
      localStorage.setItem('dracula_toggle_count', 'feedback');
      wp.ajax.post('dracula_insert_feedback', {
        message,
        nonce: dracula.nonce
      });
    }
  });
}

/**
 * Batch DOM Updates:
 * Rather than updating each element one by one in a loop, collect all changes and apply them in one batch. This reduces the number of reflows and repaints.
 */
function handleBackgroundOverlay(darkenBackgroundImages = draculaDarkMode.isEnabled()) {
  const $ = jQuery;
  const elementsToUpdate = [];
  if (darkenBackgroundImages) {
    $('body, div, header, footer, section, article, aside, main, figure, aside').each((index, element) => {
      const $element = $(element);

      // check if element or any parent has .dracula-ignore then skip
      if ($element.hasClass('dracula-ignore') || $element.parents('.dracula-ignore').length) return;
      const bgImage = $element.css('background-image');
      if ('none' === bgImage || bgImage.startsWith('linear-gradient')) return;
      const imageURL = bgImage.replace(/url\((['"])?(.*?)\1\)/gi, '$2').split(',')[0];
      if (!imageURL) return;

      // data:image/svg+xml in background-image return
      if (imageURL.includes('data:image/svg+xml')) return;
      const newBgImage = `linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url(${imageURL})`;
      elementsToUpdate.push(() => {
        $element.css('background-image', newBgImage);
        $element.attr('data-dracula-bg-overlay', bgImage);
      });
    });
  } else {
    $('[data-dracula-bg-overlay]').each((index, element) => {
      const $element = $(element);
      const bgImage = $element.attr('data-dracula-bg-overlay');
      elementsToUpdate.push(() => {
        $element.css('background-image', bgImage);
        $element.removeAttr('data-dracula-bg-overlay');
      });
    });
  }
  elementsToUpdate.forEach(updateFn => updateFn());
}
async function showReviewPopup() {
  const lastReviewPopup = localStorage.getItem('dracula_last_review_popup');
  let remindInDays = Number(localStorage.getItem('dracula_remind_in_days')) || 2;
  const currentDate = new Date().getTime();
  const intervalMilliseconds = remindInDays * 24 * 60 * 60 * 1000;

  // If the popup has never been shown, or it's been more than the interval since it was last shown
  if (lastReviewPopup && currentDate - lastReviewPopup <= intervalMilliseconds) return;
  localStorage.setItem('dracula_last_review_popup', new Date().getTime()); // save the current date as the last shown date

  const result = await Swal.fire({
    title: wp.i18n.__('Are You Enjoying This Plugin?', 'dracula-dark-mode'),
    text: wp.i18n.__('Your feedback helps us create a better experience for you.', 'dracula-dark-mode'),
    icon: 'question',
    showDenyButton: true,
    confirmButtonText: wp.i18n.__('Yes, I\'m enjoying it!', 'dracula-dark-mode'),
    denyButtonText: wp.i18n.__('Not really', 'dracula-dark-mode'),
    reverseButtons: true,
    allowOutsideClick: false,
    allowEscapeKey: false,
    showCloseButton: true,
    customClass: {
      container: 'dracula-swal dracula-review-swal'
    }
  }).then(result => {
    if (result.isConfirmed) {
      Swal.fire({
        title: wp.i18n.__('We\'re glad to hear that!', 'dracula-dark-mode'),
        text: wp.i18n.__('Would you mind taking a few minutes to rate us and write a review?', 'dracula-dark-mode'),
        icon: 'success',
        showDenyButton: true,
        confirmButtonText: wp.i18n.__('Sure, I\'d be happy to', 'dracula-dark-mode'),
        denyButtonText: wp.i18n.__('Maybe later', 'dracula-dark-mode'),
        reverseButtons: true,
        allowOutsideClick: false,
        allowEscapeKey: false,
        customClass: {
          container: 'dracula-swal dracula-review-swal'
        }
      }).then(result => {
        if (result.isConfirmed) {
          window.open('https://wordpress.org/support/plugin/dracula-dark-mode/reviews/?filter=5#new-post', '_blank');
          wp.ajax.post('dracula_hide_review_notice', {
            nonce: dracula.nonce
          });
        } else if (result.isDenied) {
          localStorage.setItem('dracula_remind_in_days', 7);
        }
      });
    } else if (result.isDenied) {
      Swal.fire({
        title: wp.i18n.__('Sorry to hear that!', 'dracula-dark-mode'),
        text: wp.i18n.__('Could you please provide us with some feedback to help us improve?', 'dracula-dark-mode'),
        input: 'textarea',
        inputPlaceholder: wp.i18n.__('Enter your feedback here...', 'dracula-dark-mode'),
        showCancelButton: false,
        confirmButtonText: wp.i18n.__('Submit', 'dracula-dark-mode'),
        showLoaderOnConfirm: true,
        showCloseButton: true,
        allowOutsideClick: false,
        allowEscapeKey: false,
        customClass: {
          container: 'dracula-swal dracula-review-swal'
        }
      }).then(result => {
        if (result.isConfirmed) {
          Swal.fire({
            title: wp.i18n.__('Thank you for your feedback!', 'dracula-dark-mode'),
            text: wp.i18n.__("We'll use your feedback to improve our plugin.", 'dracula-dark-mode'),
            icon: 'info',
            customClass: {
              container: 'dracula-swal dracula-review-swal'
            }
          });
          wp.ajax.post('dracula_review_feedback', {
            nonce: dracula.nonce,
            feedback: result.value
          });
        } else if (result.isDismissed) {
          wp.ajax.post('dracula_hide_review_notice', {
            nonce: dracula.nonce
          });
        }
      });
    }
  });
}
function addDarkModeSelectorPrefix(css) {
  // Split the CSS into rules using the '}' delimiter
  let rules = css.split('}');

  // Iterate over each rule
  rules = rules.map(rule => {
    // Check if there is content in the rule (to avoid empty strings)
    if (rule.trim()) {
      // Add the .dark-mode prefix to the selector
      // We use '{' as a delimiter to find the end of the selector
      let parts = rule.split('{', 2);
      if (parts.length === 2) {
        let selectors = parts[0].split(',');
        selectors = selectors.map(selector => {
          selector = selector.trim();
          // Prepend .dark-mode to each selector
          return 'html[data-dracula-scheme="dark"] ' + selector;
        });
        // Reassemble the rule with modified selectors
        return selectors.join(', ') + '{' + parts[1];
      }
    }
    return '';
  });

  // Reassemble the CSS
  return rules.join('}');
}
function colorBrightness(hex, steps) {
  // Return if not hex color
  if (!/^#([a-f0-9]{3}){1,2}$/i.test(hex)) {
    return hex;
  }

  // Steps should be between -255 and 255. Negative = darker, positive = lighter
  steps = Math.max(-255, Math.min(255, steps));

  // Normalize into a six character long hex string
  hex = hex.replace('#', '');
  if (hex.length === 3) {
    hex = hex.split('').map(char => char + char).join('');
  }

  // Split into three parts: R, G, B
  let colorParts = hex.match(/.{2}/g);
  let result = '#';
  for (let color of colorParts) {
    color = parseInt(color, 16); // Convert to decimal
    color = Math.max(0, Math.min(255, color + steps)); // Adjust color
    result += color.toString(16).padStart(2, '0'); // Make two char hex code
  }
  return result;
}

/**
 * Reading progress
 * @reading_mode
 */
const handleReadingProgress = () => {
  const readingProgress = document.querySelector('.reading-mode-progress');
  if (readingProgress) {
    let w = (document.body.scrollTop || document.documentElement.scrollTop) / (document.documentElement.scrollHeight - document.documentElement.clientHeight) * 100;
    readingProgress.style.setProperty('width', w + '%');
  }
};

/**
 * check visible
 * @reading_mode
 */
const isVisible = function (ele, container) {
  const {
    bottom,
    height,
    top
  } = ele.getBoundingClientRect();
  const containerRect = container.getBoundingClientRect();
  return top <= containerRect.top ? containerRect.top - top <= height : bottom - containerRect.bottom <= height;
};
function reloadDisqus() {
  if (typeof DISQUS !== "undefined") {
    DISQUS.reset({
      reload: true,
      config: function () {
        this.page.identifier = window.location.pathname; // Set unique identifier
        this.page.url = window.location.href; // Set page URL
      }
    });
  }
}
function darkenBgImage(element) {
  if (!element) return;
  const {
    darkenBackgroundImagesLevel = 60
  } = dracula?.settings || {};
  const level = darkenBackgroundImagesLevel / 100; // Convert to a fraction

  const isDarkModeEnabled = window.draculaDarkMode.isEnabled();
  const mainStyle = window.getComputedStyle(element);
  const beforeStyle = window.getComputedStyle(element, ":before");
  const afterStyle = window.getComputedStyle(element, ":after");
  const gradient = url => `linear-gradient(rgba(0, 0, 0, ${level}), rgba(0, 0, 0, ${level})), ${url}`;
  const createStyleElement = (id, cssText) => {
    let styleEl = document.getElementById(id);
    if (!styleEl) {
      styleEl = document.createElement("style");
      styleEl.id = id;
      document.head.appendChild(styleEl);
    }
    styleEl.textContent = cssText;
  };
  const applyPseudoDarken = (pseudoStyle, pseudo, datasetKey) => {
    const bgImage = pseudoStyle.backgroundImage;
    if (bgImage !== "none" && bgImage.includes("url") && !bgImage.includes(`rgba(0, 0, 0, ${level})`)) {
      const styleId = `dracula-${pseudo}-${Math.random().toString(36).substr(2, 9)}`;
      element.setAttribute(`data-dracula-${pseudo}-style-id`, styleId);
      element.dataset[datasetKey] = bgImage;
      const css = addDarkModeSelectorPrefix(`
                [data-dracula-${pseudo}-style-id="${styleId}"]::${pseudo} {
                    background-image: ${gradient(bgImage)} !important;
                }
            `);
      createStyleElement(styleId, css);
      if (mainStyle.position === "static") {
        element.style.position = "relative";
      }
    }
  };
  if (isDarkModeEnabled) {
    const bgImage = mainStyle.backgroundImage;
    if (bgImage !== "none" && bgImage.includes("url") && !bgImage.includes(`rgba(0, 0, 0, ${level})`)) {
      element.style.setProperty("background-image", gradient(bgImage));
    }
    applyPseudoDarken(beforeStyle, "before", "draculaOriginalBeforeBg");
    applyPseudoDarken(afterStyle, "after", "draculaOriginalAfterBg");
  } else {
    const bgImage = mainStyle.backgroundImage;
    const darkGradient = `linear-gradient(rgba(0, 0, 0, ${level}), rgba(0, 0, 0, ${level})), `;
    if (bgImage.includes(darkGradient)) {
      element.style.setProperty("background-image", bgImage.replace(darkGradient, ""));
    }
  }
}

/**
 * Handle Images Behaviour
 *
 * @param element
 */
function handleImageBehaviour(element) {
  if (!element) return;
  const {
    lowBrightnessImages = true,
    lowBrightnessLevel = 80,
    grayscaleImages,
    grayscaleImagesLevel = 80,
    invertImages,
    invertImagesLevel = 80
  } = dracula?.settings || {};
  const isDarkModeEnabled = window?.draculaDarkMode?.isEnabled();
  const className = "dracula_filter_applied";
  if (isDarkModeEnabled) {
    if (!element.classList.contains(className)) {
      element.dataset.draculaOriginalFilter = element.style.filter || "";
      element.classList.add(className);
      const filters = [];
      if (lowBrightnessImages) {
        filters.push(`brightness(${lowBrightnessLevel}%)`);
      }
      if (grayscaleImages) {
        filters.push(`grayscale(${grayscaleImagesLevel}%)`);
      }
      if (invertImages) {
        filters.push(`invert(${invertImagesLevel}%)`);
      }
      if (filters.length > 0) {
        element.style.filter = filters.join(" ");
      }
    }
  } else {
    if (element.classList.contains(className)) {
      element.style.filter = element.dataset.draculaOriginalFilter || "";
      element.classList.remove(className);
      delete element.dataset.draculaOriginalFilter;
    }
  }
}
function invertInlineSvg(element) {
  if (!element) return;
  const isDarkModeEnabled = draculaDarkMode.isEnabled();
  const invertClass = "dracula_inverted_inline_svg";
  const invertValue = "invert(1)";
  if (isDarkModeEnabled) {
    if (!element.classList.contains(invertClass)) {
      element.dataset.originalFilter = element.style.filter || "";
      const currentFilter = element.style.filter || "";

      // Only add invert if not already present
      if (!currentFilter.includes(invertValue)) {
        element.style.filter = `${invertValue} ${currentFilter}`.trim();
      }
      element.classList.add(invertClass);
    }
  } else if (element.classList.contains(invertClass)) {
    const currentFilter = element.style.filter || "";

    // Remove only the invert(1) part
    const cleanedFilter = currentFilter.replace(invertValue, "").replace(/\s+/g, " ").trim();
    element.style.filter = element.dataset.originalFilter || cleanedFilter;
    element.classList.remove(invertClass);
    delete element.dataset.originalFilter;
  }
}

/**
 * Handle Videos Behaviour
 *
 * @param element
 */
function handleVideoBehaviour(element) {
  if (!element) return;
  const {
    lowBrightnessVideos,
    videoBrightnessLevel = 80,
    grayscaleVideos,
    grayscaleVideosLevel = 80
  } = dracula?.settings || {};
  const isDarkModeEnabled = draculaDarkMode.isEnabled();
  const className = "dracula_filter_applied";
  if (isDarkModeEnabled) {
    if (!element.classList.contains(className)) {
      element.dataset.draculaOriginalFilter = element.style.filter || "";
      element.classList.add(className);
      const filters = [];
      if (lowBrightnessVideos) {
        filters.push(`brightness(${videoBrightnessLevel}%)`);
      }
      if (grayscaleVideos) {
        filters.push(`grayscale(${grayscaleVideosLevel}%)`);
      }
      if (filters.length > 0) {
        element.style.filter = filters.join(" ");
      }
    }
  } else {
    if (element.classList.contains(className)) {
      element.style.filter = element.dataset.draculaOriginalFilter || "";
      element.classList.remove(className);
      delete element.dataset.draculaOriginalFilter;
    }
  }
}
function fixBackgroundColorAlpha(element) {
  if (!element || !element.hasAttribute("data-dracula_alpha_bg")) return;
  const isDarkModeEnabled = window?.draculaDarkMode?.isEnabled();
  if (isDarkModeEnabled) {
    const storedRgba = element.dataset.dracula_alpha_bg;
    if (!storedRgba || !storedRgba.startsWith("rgba(")) return;
    const rgbaParts = storedRgba.replace("rgba(", "").replace(")", "").split(",");
    const alpha = rgbaParts[3]?.trim();
    if (!alpha) return;
    const computedBg = window.getComputedStyle(element).backgroundColor;

    // Only convert if current background is in `rgb` format (not already rgba)
    if (computedBg && computedBg.startsWith("rgb(")) {
      const rgbaColor = computedBg.replace("rgb(", "rgba(").replace(")", `, ${alpha})`);
      element.style.setProperty("background-color", rgbaColor, "important");
    }
  } else {
    // Reset to default background color
    element.style.backgroundColor = "";
  }
}
function initToggle() {
  const $ = jQuery;
  const {
    customSwitches = {},
    isPro,
    switches = {},
    settings
  } = dracula;
  const {
    showTooltip,
    lightTooltipText = 'Toggle Dark Mode',
    darkTooltipText = 'Toggle Light Mode',
    draggableToggle,
    pageTransition,
    enableAnalytics,
    enableFeedback
  } = settings;
  const config = getConfig();
  const elements = document.querySelectorAll('.dracula-toggle-wrap');
  elements.forEach(element => {
    const $element = $(element);
    $element.find('.dracula-toggle').remove();
    let style = $element.data('style') || '1';
    const id = $element.data('id');
    const styleInt = parseInt(style, 10);
    const mode = typeof draculaDarkMode !== 'undefined' && window.draculaDarkMode?.isEnabled() ? 'dark' : 'light';
    let data = {};
    if (id) {
      try {
        data = JSON.parse(atob($element.data('data')));
      } catch (e) {
        console.error('Error parsing toggle data:', e);
      }
    }
    const layoutClass = data.layout ? `layout-${data.layout}` : '';
    const className = data.className || '';
    const tag = [14, 17, 18].includes(styleInt) ? 'div' : 'button';
    const switchHTML = id ? customSwitches[data.layout]?.trim() : switches[styleInt]?.trim();
    const $toggle = $(`<${tag}>`, {
      type: tag === 'button' ? 'button' : undefined,
      class: `dracula-toggle dracula-ignore ${!id ? `style-${styleInt}` : ''} mode-${mode} ${layoutClass} ${className}`,
      'aria-label': wp.i18n.__('Dark Mode Toggle', 'dracula-dark-mode'),
      html: switchHTML
    });

    // Apply custom toggle styles and labels
    if (Object.keys(data).length) {
      const getIconUrl = (custom, fallback) => `url("${custom || `${dracula.pluginUrl}/assets/images/icons/${fallback}.svg`}") no-repeat center / contain`;
      const customStyle = `
                        --toggle-icon-light: ${getIconUrl(data.customLightIcon, data.lightIcon)};
                        --toggle-icon-dark: ${getIconUrl(data.customDarkIcon, data.darkIcon)};
                        --toggle-width: ${data.width}px;
                        --toggle-padding: ${data.padding}px;
                        --toggle-text-size: ${data.textSize}px;
                        --toggle-bg-light: ${data.lightBackgroundColor};
                        --toggle-bg-dark: ${data.darkBackgroundColor};
                        --toggle-text-color-light: ${data.lightTextColor};
                        --toggle-text-color-dark: ${data.darkTextColor};
                        --toggle-border-w: ${data.borderWidth}px;
                        --toggle-border-color-light: ${data.lightBorderColor};
                        --toggle-border-color-dark: ${data.darkBorderColor};
                        --toggle-border-radius: ${data.borderRadius}px;
                        --toggle-icon-spacing: ${data.iconSpacing}px;
                    `;
      $toggle.attr('style', customStyle);
      $toggle.find('.dracula-toggle-label .--light, .toggle-prefix, .dracula-toggle-label.--light').html(data.lightLabel);
      $toggle.find('.dracula-toggle-label .--dark, .toggle-suffix, .dracula-toggle-label.--dark').html(data.darkLabel);
      if (data.layout === 2) {
        $toggle.find(`.dracula-toggle-icon:not(.position-${data.iconPosition})`).remove();
      }
    }

    // update text on the dark mode
    if (mode === 'dark') {
      jQuery('.dracula-toggle-text').text("Dark Mode");
    } else {
      jQuery('.dracula-toggle-text').text("Light Mode");
    }

    // Tooltip
    if ((!!data.showTooltip || !!showTooltip) && !dracula.isAdmin) {
      $element.append(`<div class="dracula-tooltip">${mode === 'light' ? data.tooltipText || lightTooltipText : data.darkTooltipText || darkTooltipText}</div>`);
    }
    if ([17, 18].includes(styleInt)) {
      const $icons = $toggle.find('.dracula-toggle-icon.--light, .dracula-toggle-icon.--dark');
      const $typography = $toggle.find('.dracula-toggle-icon.--typography');
      $icons.on('click', e => {
        e.preventDefault();
        draculaDarkMode.toggle(config);

        // Analytics
        if (isPro && enableAnalytics) {
          // Send activation/deactivation analytics event
          wp.ajax.post('dracula_track_analytics', {
            type: 'dark' === mode ? 'activation' : 'deactivation'
          });

          // Prompt feedback
          if (enableFeedback) {
            let prevCount = localStorage.getItem('dracula_toggle_count');
            if ('feedback' !== prevCount) {
              prevCount = parseInt(prevCount || 0);
              localStorage.setItem('dracula_toggle_count', (prevCount + 1).toString());
              if (prevCount > 4 && prevCount % 5 === 0) {
                setTimeout(() => {
                  promptFeedback();
                }, 1000);
              }
            }
          }
        }
      });
      $typography.on('click', e => {
        e.preventDefault();
        const id = '#dracula-font-size-css';
        const $css = $(id);
        $css.length ? $css.remove() : $('<style>', {
          id: id.substring(1),
          html: ` 
                        html body > *:not(#dracula-live-edit, .dracula-toggle-wrap, .dracula-toggle),
                        html[data-dracula-scheme="dark"] body > *:not(#dracula-live-edit, .dracula-toggle-wrap, .dracula-toggle){
                            zoom:1.2
                        }
                    `
        }).appendTo('head');
      });
    } else {
      $toggle.on('click', e => {
        e.preventDefault();
        if (styleInt === 14) {
          const $modal = $toggle.find('.toggle-modal');
          $modal.toggleClass('open');
          $modal.find('.toggle-option.light').on('click', e => {
            e.preventDefault();
            draculaDarkMode.disable();
          });
          $modal.find('.toggle-option.dark').on('click', e => {
            e.preventDefault();
            draculaDarkMode.enable(config);
          });
          $modal.find('.toggle-option.auto').on('click', e => {
            e.preventDefault();
            draculaDarkMode.auto();
          });

          // Dismiss modal on outside click
          $(document).on('click.dracula-toggle', e => {
            if (!$modal.hasClass('open')) return;
            if (!$(e.target).closest('.toggle-modal, .dracula-toggle').length) {
              $modal.removeClass('open');
            }
          });
        } else {
          handleAnimation(mode, '', pageTransition);
          window.draculaDarkMode.toggle(config);
          if (styleInt === 13 || styleInt === 16) {
            if (window.draculaDarkMode.isEnabled()) {
              jQuery('.toggle-prefix-text').text("Dark Mode");
            } else {
              jQuery('.toggle-prefix-text').text("Light Mode");
            }
          }
        }

        // Analytics
        if (isPro && enableAnalytics) {
          // Send activation/deactivation analytics event
          wp.ajax.post('dracula_track_analytics', {
            type: 'dark' === mode ? 'activation' : 'deactivation'
          });

          // Prompt feedback
          if (enableFeedback) {
            let prevCount = localStorage.getItem('dracula_toggle_count');
            if ('feedback' !== prevCount) {
              prevCount = parseInt(prevCount || 0);
              localStorage.setItem('dracula_toggle_count', (prevCount + 1).toString());
              if (prevCount > 4 && prevCount % 5 === 0) {
                setTimeout(() => {
                  promptFeedback();
                }, 1000);
              }
            }
          }
        }
      });
    }

    // Add draggable toggle
    if (draggableToggle) {
      $element.append(`
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                    class="dracula-toggle-move">
                    <rect x="0" fill="none" width="20" height="20" />
                    <g>
                        <path d="M19 10l-4 4v-3h-4v4h3l-4 4-4-4h3v-4H5v3l-4-4 4-4v3h4V5H6l4-4 4 4h-3v4h4V6z" />
                    </g>
                </svg>    
            `);
    }
    $element.append($toggle);
  });
}
function hexToRgba(hex, alpha = 1) {
  // Remove "#" if present
  hex = hex.replace(/^#/, '');

  // Expand shorthand (#f00 → #ff0000)
  if (hex.length === 3) {
    hex = hex.split('').map(char => char + char).join('');
  }

  // Invalid HEX fallback
  if (hex.length !== 6 || !/^[0-9A-Fa-f]{6}$/.test(hex)) {
    return `rgba(0,0,0,${alpha})`;
  }

  // Convert to RGB
  const r = parseInt(hex.substring(0, 2), 16);
  const g = parseInt(hex.substring(2, 4), 16);
  const b = parseInt(hex.substring(4, 6), 16);

  // Clamp alpha between 0–1
  alpha = Math.min(1, Math.max(0, alpha));
  return `rgba(${r}, ${g}, ${b}, ${alpha})`;
}

/**
 * Handles the attention effect for the floating toggle.
 *
 * @author Monzur Alam
 * @since 1.2.9
 * @returns {Function} A function to clear the interval.
 */
function handleAttentionEffect() {
  const {
    attentionEffect = 'none'
  } = dracula.settings;
  if (!dracula.isPro) return;
  const element = jQuery('.dracula-toggle-wrap.floating');
  if (!element.length) return;
  function removeEffectClass() {
    const matchedClasses = element.attr('class').match(/\bdracula-effect-\S+/g) || [];
    element.removeClass(matchedClasses.join(' '));
  }

  // Stop previous interval
  if (window.draculaEffectInterval) {
    clearInterval(window.draculaEffectInterval);
  }
  if (!attentionEffect || attentionEffect === 'none') {
    removeEffectClass();
    return;
  }

  // Set new interval
  window.draculaEffectInterval = setInterval(() => {
    removeEffectClass();
    setTimeout(() => {
      element.addClass(`dracula-effect-${attentionEffect}`);
    }, 50);
  }, 7000);
}

/**
 * Handles the draggable toggle feature.
 *
 * @author Monzur Alam
 * @since 1.2.9
 */
function handleDraggableToggle() {
  if (!dracula.isPro) return;
  const {
    draggableToggle
  } = dracula.settings;
  if (!draggableToggle) return;
  const element = document.querySelector('.dracula-toggle-wrap.floating');
  if (!element) return;

  // Restore saved position
  const saved = localStorage.getItem('dracula_floating_position');
  if (saved) {
    const pos = JSON.parse(saved);
    element.style.position = 'fixed';
    element.style.top = pos.top + 'px';
    element.style.left = pos.left + 'px';
  }
  let isDragging = false,
    offsetX = 0,
    offsetY = 0;
  element.addEventListener('mousedown', e => {
    isDragging = true;
    offsetX = e.clientX - element.getBoundingClientRect().left;
    offsetY = e.clientY - element.getBoundingClientRect().top;
  });
  document.addEventListener('mousemove', e => {
    if (!isDragging) return;
    const left = e.clientX - offsetX;
    const top = e.clientY - offsetY;
    element.style.position = 'fixed';
    element.style.left = left + 'px';
    element.style.top = top + 'px';
    localStorage.setItem('dracula_floating_position', JSON.stringify({
      top,
      left
    }));
  });
  document.addEventListener('mouseup', () => isDragging = false);
}
function handleDraculaHides() {
  if (!dracula.isPro) return;
  const {
    hides
  } = dracula?.settings;
  if (!hides || !hides.length) {
    const oldStyle = document.getElementById('dracula-hides-css');
    if (oldStyle) oldStyle.remove();
    return;
  }
  let css = hides.map(sel => `${sel} { display: none !important; }`).join("\n");
  let styleElement = document.getElementById('dracula-hides-css');
  if (!styleElement) {
    styleElement = document.createElement('style');
    styleElement.id = 'dracula-hides-css';
    document.head.appendChild(styleElement);
  }
  styleElement.textContent = css;
}
function handleDraculaFont(isDarkMode) {
  const {
    changeFont,
    fontFamily,
    textStroke
  } = dracula.settings;
  if (!changeFont || !fontFamily) return;
  let fontLink = document.getElementById('dracula-font-link');
  if (!fontLink) {
    fontLink = document.createElement('link');
    fontLink.id = 'dracula-font-link';
    fontLink.rel = 'stylesheet';
    fontLink.href = `https://fonts.googleapis.com/css?family=${fontFamily}`;
    document.head.appendChild(fontLink);
  }
  let element = document.querySelector('.dracula--text');
  const elementCSS = `
        *:not(
            pre,
            pre *,
            code,
            [aria-hidden="true"],
            [class*="fa-"],
            .fa,
            .fab,
            .fad,
            .fal,
            .far,
            .fas,
            .fass,
            .fasr,
            .fat,
            .icofont,
            [style*="font-"],
            [class*="icon"],
            [class*="Icon"],
            [class*="symbol"],
            [class*="Symbol"],
            .glyphicon,
            [class*="material-symbol"],
            [class*="material-icon"],
            mu,
            [class*="mu-"],
            .typcn,
            [class*="vjs-"],
            .dashicons,
            .ab-icon,
            .dracula-ignore *,
            i
        ) {
            font-family: ${fontFamily} !important;
            -webkit-text-stroke: ${textStroke}px !important;
        }
    `;

  // create element if not exist
  if (!element) {
    element = document.createElement('style');
    element.className = 'dracula--text';
    document.head.appendChild(element);
  }

  // update element
  if (isDarkMode) {
    element.innerHTML = elementCSS;
  } else {
    element.innerHTML = '';
  }
}

/***/ }),

/***/ "./src/switch/block.json":
/*!*******************************!*\
  !*** ./src/switch/block.json ***!
  \*******************************/
/***/ ((module) => {

module.exports = /*#__PURE__*/JSON.parse('{"$schema":"https://json.schemastore.org/block.json","apiVersion":2,"name":"dracula/switch","version":"1.0.0","title":"Dark Mode Switch","category":"widgets","description":"Insert a dark mode toggle switch into your content.","supports":{"html":false},"attributes":{"style":{"type":"number","default":1},"data":{"type":"object"}},"keywords":["dark mode","switch","dracula"],"textdomain":"dracula","editorScript":"file:./index.js","editorStyle":"file:./index.css"}');

/***/ }),

/***/ "./src/switch/edit.js":
/*!****************************!*\
  !*** ./src/switch/edit.js ***!
  \****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ Edit)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/block-editor */ "@wordpress/block-editor");
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _src_js_components_Settings_Toggles__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../../../src/js/components/Settings/Toggles */ "../src/js/components/Settings/Toggles.js");
/* harmony import */ var _src_js_includes_functions__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../../../src/js/includes/functions */ "../src/js/includes/functions.js");






function Edit({
  attributes,
  setAttributes
}) {
  const {
    style = 1,
    data = {}
  } = attributes;
  const toggleRef = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_2__.useRef)(null);
  (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_2__.useEffect)(() => {
    if (!toggleRef.current) return;
    const $ = window.jQuery;
    const $toggle = $(toggleRef.current);
    $toggle.data({
      style,
      data: data ? btoa(JSON.stringify(data)) : '',
      id: data?.id || ''
    });
    (0,_src_js_includes_functions__WEBPACK_IMPORTED_MODULE_5__.initToggle)();
  }, [style, data]);
  return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    ...(0,_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3__.useBlockProps)()
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3__.InspectorControls, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__.PanelBody, {
    title: "Switch Style",
    initialOpen: true
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__.PanelRow, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_src_js_components_Settings_Toggles__WEBPACK_IMPORTED_MODULE_4__["default"], {
    value: style,
    onChange: (style, newData) => {
      setAttributes({
        style: parseInt(style, 10),
        data: newData
      });
    }
  })))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    ref: toggleRef,
    className: `dracula-toggle-wrap ${data ? 'custom-toggle' : ''}`
  }));
}

/***/ }),

/***/ "./src/switch/index.scss":
/*!*******************************!*\
  !*** ./src/switch/index.scss ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "@wordpress/block-editor":
/*!*************************************!*\
  !*** external ["wp","blockEditor"] ***!
  \*************************************/
/***/ ((module) => {

module.exports = window["wp"]["blockEditor"];

/***/ }),

/***/ "@wordpress/components":
/*!************************************!*\
  !*** external ["wp","components"] ***!
  \************************************/
/***/ ((module) => {

module.exports = window["wp"]["components"];

/***/ }),

/***/ "@wordpress/element":
/*!*********************************!*\
  !*** external ["wp","element"] ***!
  \*********************************/
/***/ ((module) => {

module.exports = window["wp"]["element"];

/***/ }),

/***/ "react":
/*!************************!*\
  !*** external "React" ***!
  \************************/
/***/ ((module) => {

module.exports = window["React"];

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry needs to be wrapped in an IIFE because it needs to be isolated against other modules in the chunk.
(() => {
/*!*****************************!*\
  !*** ./src/switch/index.js ***!
  \*****************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _block_json__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./block.json */ "./src/switch/block.json");
/* harmony import */ var _edit__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./edit */ "./src/switch/edit.js");
/* harmony import */ var _index_scss__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./index.scss */ "./src/switch/index.scss");

const {
  registerBlockType
} = wp.blocks;



const icon = (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("svg", {
  width: "20",
  height: "20",
  viewBox: "0 0 30 30",
  fill: "none",
  xmlns: "http://www.w3.org/2000/svg"
}, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("path", {
  d: "M29.9916 2.26879C29.9916 2.03651 29.9786 1.79133 29.9012 1.57196C29.475 0.20411 27.951 -0.324963 26.7241 0.526716C24.9548 1.73971 23.2242 3.01723 21.4548 4.23023C21.1836 4.4238 20.7962 4.55284 20.4604 4.55284C18.6394 4.56574 16.8313 4.56574 15.0103 4.56574C13.2151 4.56574 11.4071 4.56574 9.61189 4.53993C9.23736 4.53993 8.81117 4.38508 8.51413 4.16571C6.80937 2.96562 5.11752 1.73972 3.43859 0.500908C2.71535 -0.0281659 1.95338 -0.170113 1.13974 0.229919C0.326101 0.62995 0.00322882 1.33968 0.00322882 2.24298C0.0161437 4.50122 0.00322882 6.75947 0.00322882 9.01771C0.00322882 10.9921 -0.00968625 12.9793 0.0161435 14.9537C0.0290584 15.7408 0.0548887 16.5538 0.171123 17.328C1.37221 24.7867 7.71341 29.9871 14.9974 30C15.9789 30 16.9605 29.9097 17.9678 29.7161C24.6965 28.4257 29.9141 22.2446 29.9787 15.4182C30.0174 11.0437 29.9916 6.65623 29.9916 2.26879Z",
  fill: "white"
}), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("path", {
  d: "M18.1658 18.749C19.6894 18.7344 20.9083 18.1972 21.9385 17.1518C22.0836 17.0066 22.3158 16.9486 22.519 16.8469C22.5915 17.0502 22.7221 17.268 22.7221 17.4712C22.5335 21.0866 19.6168 24.1792 16.0327 24.6148C12.0132 25.0939 8.47264 22.6547 7.50042 18.749C6.39761 14.3496 9.53192 9.80501 14.0157 9.29683C14.2479 9.26779 14.4946 9.20971 14.7267 9.23875C14.8718 9.25327 15.0605 9.35491 15.1185 9.47106C15.1621 9.55818 15.075 9.76145 14.9879 9.86308C14.7703 10.1244 14.4801 10.3567 14.2769 10.6326C11.9262 13.6817 13.6965 18.0956 17.4838 18.7054C17.7159 18.749 17.9771 18.7344 18.1658 18.749Z",
  fill: "#665CE0"
}));
registerBlockType('dracula/switch', {
  ..._block_json__WEBPACK_IMPORTED_MODULE_1__,
  icon,
  edit: _edit__WEBPACK_IMPORTED_MODULE_2__["default"]
});
})();

/******/ })()
;
//# sourceMappingURL=index.js.map