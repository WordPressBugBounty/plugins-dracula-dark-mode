tinymce.PluginManager.add("dracula_tinymce_js",(function(a){var e=function(e){var d=a.getBody(),r=draculaDarkMode.colors;e||draculaDarkMode.isEnabled()||draculaDarkMode.enable(),d.parentNode.setAttribute("data-dracula-scheme","dark"),document.querySelector(".mce-i-dracula_toggle").classList.add("mode-dark"),d.style.setProperty("--dracula-background",r.background),d.style.setProperty("--dracula-text",r.text)},d=function(e){!e&&draculaDarkMode.isEnabled()&&draculaDarkMode.disable(),a.getBody().parentNode.removeAttribute("data-dracula-scheme"),document.querySelector(".mce-i-dracula_toggle").classList.remove("mode-dark")};a.addButton("dracula_toggle",{title:wp.i18n.__("Dark Mode","dracula-dark-mode"),classes:"dracula-toggle",onclick:function(a){var r=a.target,t=!r.classList.contains("mode-dark");t?(r.classList.add("mode-dark"),e()):(r.classList.remove("mode-dark"),d());var o=t?"dark":"light";localStorage.setItem("dracula_mode_admin",o)}}),a.on("init",(function(){console.log("a"),draculaDarkMode.isEnabled()&&(!dracula.isPro&&"administrator"===dracula.currentUserRole||dracula.isPro)&&e(),document.addEventListener("dracula:enable",e),document.addEventListener("dracula:disable",d)}))}));