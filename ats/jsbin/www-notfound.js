(function(){var g=this;function h(a){a=a.split(".");for(var b=g,c;c=a.shift();)if(null!=b[c])b=b[c];else return null;return b}
function k(a){var b=typeof a;if("object"==b)if(a){if(a instanceof Array)return"array";if(a instanceof Object)return b;var c=Object.prototype.toString.call(a);if("[object Window]"==c)return"object";if("[object Array]"==c||"number"==typeof a.length&&"undefined"!=typeof a.splice&&"undefined"!=typeof a.propertyIsEnumerable&&!a.propertyIsEnumerable("splice"))return"array";if("[object Function]"==c||"undefined"!=typeof a.call&&"undefined"!=typeof a.propertyIsEnumerable&&!a.propertyIsEnumerable("call"))return"function"}else return"null";
else if("function"==b&&"undefined"==typeof a.call)return"object";return b}function l(a){return"string"==typeof a}var m="closure_uid_"+(1E9*Math.random()>>>0),n=0;function aa(a,b){var c=Array.prototype.slice.call(arguments,1);return function(){var b=c.slice();b.push.apply(b,arguments);return a.apply(this,b)}}function p(a,b){var c=a.split("."),d=g;c[0]in d||!d.execScript||d.execScript("var "+c[0]);for(var e;c.length&&(e=c.shift());)c.length||void 0===b?d[e]?d=d[e]:d=d[e]={}:d[e]=b};var r=String.prototype.trim?function(a){return a.trim()}:function(a){return a.replace(/^[\s\xa0]+|[\s\xa0]+$/g,"")};function v(a,b){return a<b?-1:a>b?1:0};var w=Array.prototype,ba=w.indexOf?function(a,b,c){return w.indexOf.call(a,b,c)}:function(a,b,c){c=null==c?0:0>c?Math.max(0,a.length+c):c;if(l(a))return l(b)&&1==b.length?a.indexOf(b,c):-1;for(;c<a.length;c++)if(c in a&&a[c]===b)return c;return-1},x=w.forEach?function(a,b,c){w.forEach.call(a,b,c)}:function(a,b,c){for(var d=a.length,e=l(a)?a.split(""):a,f=0;f<d;f++)f in e&&b.call(c,e[f],f,a)};var y;t:{var z=g.navigator;if(z){var A=z.userAgent;if(A){y=A;break t}}y=""};var ca=-1!=y.indexOf("Opera")||-1!=y.indexOf("OPR"),B=-1!=y.indexOf("Trident")||-1!=y.indexOf("MSIE"),C=-1!=y.indexOf("Gecko")&&-1==y.toLowerCase().indexOf("webkit")&&!(-1!=y.indexOf("Trident")||-1!=y.indexOf("MSIE")),da=-1!=y.toLowerCase().indexOf("webkit");function D(){var a=g.document;return a?a.documentMode:void 0}
var E=function(){var a="",b;if(ca&&g.opera)return a=g.opera.version,"function"==k(a)?a():a;C?b=/rv\:([^\);]+)(\)|;)/:B?b=/\b(?:MSIE|rv)[: ]([^\);]+)(\)|;)/:da&&(b=/WebKit\/(\S+)/);b&&(a=(a=b.exec(y))?a[1]:"");return B&&(b=D(),b>parseFloat(a))?String(b):a}(),F={};
function G(a){if(!F[a]){for(var b=0,c=r(String(E)).split("."),d=r(String(a)).split("."),e=Math.max(c.length,d.length),f=0;0==b&&f<e;f++){var q=c[f]||"",ea=d[f]||"",fa=RegExp("(\\d*)(\\D*)","g"),ga=RegExp("(\\d*)(\\D*)","g");do{var t=fa.exec(q)||["","",""],u=ga.exec(ea)||["","",""];if(0==t[0].length&&0==u[0].length)break;b=v(0==t[1].length?0:parseInt(t[1],10),0==u[1].length?0:parseInt(u[1],10))||v(0==t[2].length,0==u[2].length)||v(t[2],u[2])}while(0==b)}F[a]=0<=b}}
var H=g.document,ha=H&&B?D()||("CSS1Compat"==H.compatMode?parseInt(E,10):5):void 0;var I;if(!(I=!C&&!B)){var J;if(J=B)J=B&&9<=ha;I=J}I||C&&G("1.9.1");B&&G("9");function K(a){return a?a.dataset?a.dataset[L()]:a.getAttribute("data-loaded"):null}var M={};function L(){return M.loaded||(M.loaded="loaded".replace(/\-([a-z])/g,function(a,b){return b.toUpperCase()}))};function N(){this.v=this.v;this.A=this.A}N.prototype.v=!1;function O(){N.call(this);this.d=[];this.g={}}(function(){function a(){}a.prototype=N.prototype;O.d=N.prototype;O.prototype=new a;O.base=function(a,c,d){return N.prototype[c].apply(a,Array.prototype.slice.call(arguments,2))}})();O.prototype.t=1;O.prototype.k=0;O.prototype.subscribe=function(a,b,c){var d=this.g[a];d||(d=this.g[a]=[]);var e=this.t;this.d[e]=a;this.d[e+1]=b;this.d[e+2]=c;this.t=e+3;d.push(e);return e};
O.prototype.o=function(a){if(0!=this.k)return this.j||(this.j=[]),this.j.push(a),!1;var b=this.d[a];if(b){var c=this.g[b];if(c){var d=ba(c,a);0<=d&&w.splice.call(c,d,1)}delete this.d[a];delete this.d[a+1];delete this.d[a+2]}return!!b};
O.prototype.publish=function(a,b){var c=this.g[a];if(c){this.k++;for(var d=Array(arguments.length-1),e=1,f=arguments.length;e<f;e++)d[e-1]=arguments[e];e=0;for(f=c.length;e<f;e++){var q=c[e];this.d[q+1].apply(this.d[q+2],d)}this.k--;if(this.j&&0==this.k)for(;c=this.j.pop();)this.o(c);return 0!=e}return!1};O.prototype.clear=function(a){if(a){var b=this.g[a];b&&(x(b,this.o,this),delete this.g[a])}else this.d.length=0,this.g={}};var P=window.yt&&window.yt.config_||{};p("yt.config_",P);p("yt.tokens_",window.yt&&window.yt.tokens_||{});p("yt.msgs_",window.yt&&window.yt.msgs_||{});function Q(a){var b=arguments;if(1<b.length){var c=b[0];P[c]=b[1]}else for(c in b=b[0],b)P[c]=b[c]}function R(a){return a in P?P[a]:void 0}function S(a){"function"==k(a)&&(a=ia(a));window.setTimeout(a,0)}function ia(a){return a&&window.yterr?function(){try{return a.apply(this,arguments)}catch(b){throw T(b),b;}}:a}
function T(a){var b=h("yt.www.errors.log");b?b(a,void 0):(b=R("ERRORS")||[],b.push([a,void 0]),Q("ERRORS",b))};var ja=h("yt.pubsub.instance_")||new O;O.prototype.subscribe=O.prototype.subscribe;O.prototype.unsubscribeByKey=O.prototype.o;O.prototype.publish=O.prototype.publish;O.prototype.clear=O.prototype.clear;p("yt.pubsub.instance_",ja);var U=h("yt.pubsub.subscribedKeys_")||{};p("yt.pubsub.subscribedKeys_",U);var V=h("yt.pubsub.topicToKeys_")||{};p("yt.pubsub.topicToKeys_",V);var W=h("yt.pubsub.isSynchronous_")||{};p("yt.pubsub.isSynchronous_",W);var X=h("yt.pubsub.skipSubId_")||null;
p("yt.pubsub.skipSubId_",X);function ka(a,b){var c=Y();if(c){var d=c.subscribe(a,function(){if(!X||X!=d){var c=arguments,f=function(){U[d]&&b.apply(window,c)};try{W[a]?f():S(f)}catch(q){T(q)}}},void 0);U[d]=!0;V[a]||(V[a]=[]);V[a].push(d)}}function la(a,b){var c=Y();c&&c.publish.apply(c,arguments)}function Z(a){V[a]&&(a=V[a],x(a,function(a){U[a]&&delete U[a]}),a.length=0)}function ma(a){var b=Y();if(b)if(b.clear(a),a)Z(a);else for(var c in V)Z(c)}function Y(){return h("yt.pubsub.instance_")};function na(a,b){if(window.spf){var c="";if(a){var d=a.indexOf("jsbin/"),e=a.lastIndexOf(".js"),f=d+6;-1<d&&-1<e&&e>f&&(c=a.substring(f,e),c=c.replace(oa,""),c=c.replace(pa,""),c=c.replace("debug-",""),c=c.replace("tracing-",""))}spf.script.load(a,c,b)}else qa(a,b)}
function qa(a,b){var c=ra(a),d=document.getElementById(c),e=d&&K(d),f=d&&!e;e?b&&b():(b&&(ka(c,b),b[m]||(b[m]=++n)),f||(d=sa(a,c,function(){if(!K(d)){var a=d;a&&(a.dataset?a.dataset[L()]="true":a.setAttribute("data-loaded","true"));la(c);S(aa(ma,c))}})))}
function sa(a,b,c){var d=document.createElement("script");d.id=b;d.onload=function(){c&&setTimeout(c,0)};d.onreadystatechange=function(){switch(d.readyState){case "loaded":case "complete":d.onload()}};d.src=a;a=document.getElementsByTagName("head")[0]||document.body;a.insertBefore(d,a.firstChild);return d}function ra(a){var b=document.createElement("a");b.href=a;a=b.href.replace(/^[a-zA-Z]+:\/\//,"//");for(var c=b=0;c<a.length;++c)b=31*b+a.charCodeAt(c),b%=4294967296;return"js-"+b}
var oa=/\.vflset|-vfl[a-zA-Z0-9_+=-]+/,pa=/-[a-zA-Z]{2,3}_[a-zA-Z]{2,3}(?=(\/|$))/;p("_gel",function(a){var b=document;return l(a)?b.getElementById(a):a});p("yt.setConfig",Q);p("yt.www.notfound.init",function(){var a=R("SBOX_JS_URL");a&&na(a,function(){try{h("yt.www.masthead.searchbox.init")()}catch(b){throw b.message+=' SboxUrl: "'+a+'"',b;}})});})();