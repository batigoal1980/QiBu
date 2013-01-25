(function() {
    var _jQuery = window.jQuery, _$ = window.$; var jQuery = window.jQuery = window.$ = function(selector, context) { return new jQuery.fn.init(selector, context); }; var quickExpr = /^[^<]*(<(.|\s)+>)[^>]*$|^#(\w+)$/, isSimple = /^.[^:#\[\.]*$/, undefined; jQuery.fn = jQuery.prototype = { init: function(selector, context) {
        selector = selector || document; if (selector.nodeType) { this[0] = selector; this.length = 1; return this; } if (typeof selector == "string") {
            var match = quickExpr.exec(selector); if (match && (match[1] || !context)) { if (match[1]) selector = jQuery.clean([match[1]], context); else { var elem = document.getElementById(match[3]); if (elem) { if (elem.id != match[3]) return jQuery().find(selector); return jQuery(elem); } selector = []; } } else
                return jQuery(context).find(selector);
        } else if (jQuery.isFunction(selector)) return jQuery(document)[jQuery.fn.ready ? "ready" : "load"](selector); return this.setArray(jQuery.makeArray(selector));
    }, jquery: "1.2.6", size: function() { return this.length; }, length: 0, get: function(num) { return num == undefined ? jQuery.makeArray(this) : this[num]; }, pushStack: function(elems) { var ret = jQuery(elems); ret.prevObject = this; return ret; }, setArray: function(elems) { this.length = 0; Array.prototype.push.apply(this, elems); return this; }, each: function(callback, args) { return jQuery.each(this, callback, args); }, index: function(elem) { var ret = -1; return jQuery.inArray(elem && elem.jquery ? elem[0] : elem, this); }, attr: function(name, value, type) { var options = name; if (name.constructor == String) if (value === undefined) return this[0] && jQuery[type || "attr"](this[0], name); else { options = {}; options[name] = value; } return this.each(function(i) { for (name in options) jQuery.attr(type ? this.style : this, name, jQuery.prop(this, options[name], type, i, name)); }); }, css: function(key, value) { if ((key == 'width' || key == 'height') && parseFloat(value) < 0) value = undefined; return this.attr(key, value, "curCSS"); }, text: function(text) { if (typeof text != "object" && text != null) return this.empty().append((this[0] && this[0].ownerDocument || document).createTextNode(text)); var ret = ""; jQuery.each(text || this, function() { jQuery.each(this.childNodes, function() { if (this.nodeType != 8) ret += this.nodeType != 1 ? this.nodeValue : jQuery.fn.text([this]); }); }); return ret; }, wrapAll: function(html) { if (this[0]) jQuery(html, this[0].ownerDocument).clone().insertBefore(this[0]).map(function() { var elem = this; while (elem.firstChild) elem = elem.firstChild; return elem; }).append(this); return this; }, wrapInner: function(html) { return this.each(function() { jQuery(this).contents().wrapAll(html); }); }, wrap: function(html) { return this.each(function() { jQuery(this).wrapAll(html); }); }, append: function() { return this.domManip(arguments, true, false, function(elem) { if (this.nodeType == 1) this.appendChild(elem); }); }, prepend: function() { return this.domManip(arguments, true, true, function(elem) { if (this.nodeType == 1) this.insertBefore(elem, this.firstChild); }); }, before: function() { return this.domManip(arguments, false, false, function(elem) { this.parentNode.insertBefore(elem, this); }); }, after: function() { return this.domManip(arguments, false, true, function(elem) { this.parentNode.insertBefore(elem, this.nextSibling); }); }, end: function() { return this.prevObject || jQuery([]); }, find: function(selector) { var elems = jQuery.map(this, function(elem) { return jQuery.find(selector, elem); }); return this.pushStack(/[^+>] [^+>]/.test(selector) || selector.indexOf("..") > -1 ? jQuery.unique(elems) : elems); }, clone: function(events) {
        var ret = this.map(function() {
            if (jQuery.browser.msie && !jQuery.isXMLDoc(this)) { var clone = this.cloneNode(true), container = document.createElement("div"); container.appendChild(clone); return jQuery.clean([container.innerHTML])[0]; } else
                return this.cloneNode(true);
        }); var clone = ret.find("*").andSelf().each(function() { if (this[expando] != undefined) this[expando] = null; }); if (events === true) this.find("*").andSelf().each(function(i) { if (this.nodeType == 3) return; var events = jQuery.data(this, "events"); for (var type in events) for (var handler in events[type]) jQuery.event.add(clone[i], type, events[type][handler], events[type][handler].data); }); return ret;
    }, filter: function(selector) { return this.pushStack(jQuery.isFunction(selector) && jQuery.grep(this, function(elem, i) { return selector.call(elem, i); }) || jQuery.multiFilter(selector, this)); }, not: function(selector) {
        if (selector.constructor == String) if (isSimple.test(selector)) return this.pushStack(jQuery.multiFilter(selector, this, true)); else
            selector = jQuery.multiFilter(selector, this); var isArrayLike = selector.length && selector[selector.length - 1] !== undefined && !selector.nodeType; return this.filter(function() { return isArrayLike ? jQuery.inArray(this, selector) < 0 : this != selector; });
    }, add: function(selector) { return this.pushStack(jQuery.unique(jQuery.merge(this.get(), typeof selector == 'string' ? jQuery(selector) : jQuery.makeArray(selector)))); }, is: function(selector) { return !!selector && jQuery.multiFilter(selector, this).length > 0; }, hasClass: function(selector) { return this.is("." + selector); }, val: function(value) {
        if (value == undefined) {
            if (this.length) {
                var elem = this[0]; if (jQuery.nodeName(elem, "select")) { var index = elem.selectedIndex, values = [], options = elem.options, one = elem.type == "select-one"; if (index < 0) return null; for (var i = one ? index : 0, max = one ? index + 1 : options.length; i < max; i++) { var option = options[i]; if (option.selected) { value = jQuery.browser.msie && !option.attributes.value.specified ? option.text : option.value; if (one) return value; values.push(value); } } return values; } else
                    return (this[0].value || "").replace(/\r/g, "");
            } return undefined;
        } if (value.constructor == Number) value += ''; return this.each(function() {
            if (this.nodeType != 1) return; if (value.constructor == Array && /radio|checkbox/.test(this.type)) this.checked = (jQuery.inArray(this.value, value) >= 0 || jQuery.inArray(this.name, value) >= 0); else if (jQuery.nodeName(this, "select")) { var values = jQuery.makeArray(value); jQuery("option", this).each(function() { this.selected = (jQuery.inArray(this.value, values) >= 0 || jQuery.inArray(this.text, values) >= 0); }); if (!values.length) this.selectedIndex = -1; } else
                this.value = value;
        });
    }, html: function(value) { return value == undefined ? (this[0] ? this[0].innerHTML : null) : this.empty().append(value); }, replaceWith: function(value) { return this.after(value).remove(); }, eq: function(i) { return this.slice(i, i + 1); }, slice: function() { return this.pushStack(Array.prototype.slice.apply(this, arguments)); }, map: function(callback) { return this.pushStack(jQuery.map(this, function(elem, i) { return callback.call(elem, i, elem); })); }, andSelf: function() { return this.add(this.prevObject); }, data: function(key, value) {
        var parts = key.split("."); parts[1] = parts[1] ? "." + parts[1] : ""; if (value === undefined) { var data = this.triggerHandler("getData" + parts[1] + "!", [parts[0]]); if (data === undefined && this.length) data = jQuery.data(this[0], key); return data === undefined && parts[1] ? this.data(parts[0]) : data; } else
            return this.trigger("setData" + parts[1] + "!", [parts[0], value]).each(function() { jQuery.data(this, key, value); });
    }, removeData: function(key) { return this.each(function() { jQuery.removeData(this, key); }); }, domManip: function(args, table, reverse, callback) { var clone = this.length > 1, elems; return this.each(function() { if (!elems) { elems = jQuery.clean(args, this.ownerDocument); if (reverse) elems.reverse(); } var obj = this; if (table && jQuery.nodeName(this, "table") && jQuery.nodeName(elems[0], "tr")) obj = this.getElementsByTagName("tbody")[0] || this.appendChild(this.ownerDocument.createElement("tbody")); var scripts = jQuery([]); jQuery.each(elems, function() { var elem = clone ? jQuery(this).clone(true)[0] : this; if (jQuery.nodeName(elem, "script")) scripts = scripts.add(elem); else { if (elem.nodeType == 1) scripts = scripts.add(jQuery("script", elem).remove()); callback.call(obj, elem); } }); scripts.each(evalScript); }); } 
    }; jQuery.fn.init.prototype = jQuery.fn; function evalScript(i, elem) {
        if (elem.src) jQuery.ajax({ url: elem.src, async: false, dataType: "script" }); else
            jQuery.globalEval(elem.text || elem.textContent || elem.innerHTML || ""); if (elem.parentNode) elem.parentNode.removeChild(elem);
    } function now() { return +new Date; } jQuery.extend = jQuery.fn.extend = function() { var target = arguments[0] || {}, i = 1, length = arguments.length, deep = false, options; if (target.constructor == Boolean) { deep = target; target = arguments[1] || {}; i = 2; } if (typeof target != "object" && typeof target != "function") target = {}; if (length == i) { target = this; --i; } for (; i < length; i++) if ((options = arguments[i]) != null) for (var name in options) { var src = target[name], copy = options[name]; if (target === copy) continue; if (deep && copy && typeof copy == "object" && !copy.nodeType) target[name] = jQuery.extend(deep, src || (copy.length != null ? [] : {}), copy); else if (copy !== undefined) target[name] = copy; } return target; }; var expando = "jQuery" + now(), uuid = 0, windowData = {}, exclude = /z-?index|font-?weight|opacity|zoom|line-?height/i, defaultView = document.defaultView || {}; jQuery.extend({ noConflict: function(deep) { window.$ = _$; if (deep) window.jQuery = _jQuery; return jQuery; }, isFunction: function(fn) { return !!fn && typeof fn != "string" && !fn.nodeName && fn.constructor != Array && /^[\s[]?function/.test(fn + ""); }, isXMLDoc: function(elem) { return elem.documentElement && !elem.body || elem.tagName && elem.ownerDocument && !elem.ownerDocument.body; }, globalEval: function(data) {
        data = jQuery.trim(data); if (data) {
            var head = document.getElementsByTagName("head")[0] || document.documentElement, script = document.createElement("script"); script.type = "text/javascript"; if (jQuery.browser.msie) script.text = data; else
                script.appendChild(document.createTextNode(data)); head.insertBefore(script, head.firstChild); head.removeChild(script);
        } 
    }, nodeName: function(elem, name) { return elem.nodeName && elem.nodeName.toUpperCase() == name.toUpperCase(); }, cache: {}, data: function(elem, name, data) { elem = elem == window ? windowData : elem; var id = elem[expando]; if (!id) id = elem[expando] = ++uuid; if (name && !jQuery.cache[id]) jQuery.cache[id] = {}; if (data !== undefined) jQuery.cache[id][name] = data; return name ? jQuery.cache[id][name] : id; }, removeData: function(elem, name) { elem = elem == window ? windowData : elem; var id = elem[expando]; if (name) { if (jQuery.cache[id]) { delete jQuery.cache[id][name]; name = ""; for (name in jQuery.cache[id]) break; if (!name) jQuery.removeData(elem); } } else { try { delete elem[expando]; } catch (e) { if (elem.removeAttribute) elem.removeAttribute(expando); } delete jQuery.cache[id]; } }, each: function(object, callback, args) {
        var name, i = 0, length = object.length; if (args) {
            if (length == undefined) { for (name in object) if (callback.apply(object[name], args) === false) break; } else
                for (; i < length; ) if (callback.apply(object[i++], args) === false) break;
        } else {
            if (length == undefined) { for (name in object) if (callback.call(object[name], name, object[name]) === false) break; } else
                for (var value = object[0]; i < length && callback.call(value, i, value) !== false; value = object[++i]) { } 
        } return object;
    }, prop: function(elem, value, type, i, name) { if (jQuery.isFunction(value)) value = value.call(elem, i); return value && value.constructor == Number && type == "curCSS" && !exclude.test(name) ? value + "px" : value; }, className: { add: function(elem, classNames) { jQuery.each((classNames || "").split(/\s+/), function(i, className) { if (elem.nodeType == 1 && !jQuery.className.has(elem.className, className)) elem.className += (elem.className ? " " : "") + className; }); }, remove: function(elem, classNames) { if (elem.nodeType == 1) elem.className = classNames != undefined ? jQuery.grep(elem.className.split(/\s+/), function(className) { return !jQuery.className.has(classNames, className); }).join(" ") : ""; }, has: function(elem, className) { return jQuery.inArray(className, (elem.className || elem).toString().split(/\s+/)) > -1; } }, swap: function(elem, options, callback) { var old = {}; for (var name in options) { old[name] = elem.style[name]; elem.style[name] = options[name]; } callback.call(elem); for (var name in options) elem.style[name] = old[name]; }, css: function(elem, name, force) {
        if (name == "width" || name == "height") {
            var val, props = { position: "absolute", visibility: "hidden", display: "block" }, which = name == "width" ? ["Left", "Right"] : ["Top", "Bottom"]; function getWH() { val = name == "width" ? elem.offsetWidth : elem.offsetHeight; var padding = 0, border = 0; jQuery.each(which, function() { padding += parseFloat(jQuery.curCSS(elem, "padding" + this, true)) || 0; border += parseFloat(jQuery.curCSS(elem, "border" + this + "Width", true)) || 0; }); val -= Math.round(padding + border); } if (jQuery(elem).is(":visible")) getWH(); else
                jQuery.swap(elem, props, getWH); return Math.max(0, val);
        } return jQuery.curCSS(elem, name, force);
    }, curCSS: function(elem, name, force) { var ret, style = elem.style; function color(elem) { if (!jQuery.browser.safari) return false; var ret = defaultView.getComputedStyle(elem, null); return !ret || ret.getPropertyValue("color") == ""; } if (name == "opacity" && jQuery.browser.msie) { ret = jQuery.attr(style, "opacity"); return ret == "" ? "1" : ret; } if (jQuery.browser.opera && name == "display") { var save = style.outline; style.outline = "0 solid black"; style.outline = save; } if (name.match(/float/i)) name = styleFloat; if (!force && style && style[name]) ret = style[name]; else if (defaultView.getComputedStyle) { if (name.match(/float/i)) name = "float"; name = name.replace(/([A-Z])/g, "-$1").toLowerCase(); var computedStyle = defaultView.getComputedStyle(elem, null); if (computedStyle && !color(elem)) ret = computedStyle.getPropertyValue(name); else { var swap = [], stack = [], a = elem, i = 0; for (; a && color(a); a = a.parentNode) stack.unshift(a); for (; i < stack.length; i++) if (color(stack[i])) { swap[i] = stack[i].style.display; stack[i].style.display = "block"; } ret = name == "display" && swap[stack.length - 1] != null ? "none" : (computedStyle && computedStyle.getPropertyValue(name)) || ""; for (i = 0; i < swap.length; i++) if (swap[i] != null) stack[i].style.display = swap[i]; } if (name == "opacity" && ret == "") ret = "1"; } else if (elem.currentStyle) { var camelCase = name.replace(/\-(\w)/g, function(all, letter) { return letter.toUpperCase(); }); ret = elem.currentStyle[name] || elem.currentStyle[camelCase]; if (!/^\d+(px)?$/i.test(ret) && /^\d/.test(ret)) { var left = style.left, rsLeft = elem.runtimeStyle.left; elem.runtimeStyle.left = elem.currentStyle.left; style.left = ret || 0; ret = style.pixelLeft + "px"; style.left = left; elem.runtimeStyle.left = rsLeft; } } return ret; }, clean: function(elems, context) {
        var ret = []; context = context || document; if (typeof context.createElement == 'undefined') context = context.ownerDocument || context[0] && context[0].ownerDocument || document; jQuery.each(elems, function(i, elem) {
            if (!elem) return; if (elem.constructor == Number) elem += ''; if (typeof elem == "string") { elem = elem.replace(/(<(\w+)[^>]*?)\/>/g, function(all, front, tag) { return tag.match(/^(abbr|br|col|img|input|link|meta|param|hr|area|embed)$/i) ? all : front + "></" + tag + ">"; }); var tags = jQuery.trim(elem).toLowerCase(), div = context.createElement("div"); var wrap = !tags.indexOf("<opt") && [1, "<select multiple='multiple'>", "</select>"] || !tags.indexOf("<leg") && [1, "<fieldset>", "</fieldset>"] || tags.match(/^<(thead|tbody|tfoot|colg|cap)/) && [1, "<table>", "</table>"] || !tags.indexOf("<tr") && [2, "<table><tbody>", "</tbody></table>"] || (!tags.indexOf("<td") || !tags.indexOf("<th")) && [3, "<table><tbody><tr>", "</tr></tbody></table>"] || !tags.indexOf("<col") && [2, "<table><tbody></tbody><colgroup>", "</colgroup></table>"] || jQuery.browser.msie && [1, "div<div>", "</div>"] || [0, "", ""]; div.innerHTML = wrap[1] + elem + wrap[2]; while (wrap[0]--) div = div.lastChild; if (jQuery.browser.msie) { var tbody = !tags.indexOf("<table") && tags.indexOf("<tbody") < 0 ? div.firstChild && div.firstChild.childNodes : wrap[1] == "<table>" && tags.indexOf("<tbody") < 0 ? div.childNodes : []; for (var j = tbody.length - 1; j >= 0; --j) if (jQuery.nodeName(tbody[j], "tbody") && !tbody[j].childNodes.length) tbody[j].parentNode.removeChild(tbody[j]); if (/^\s/.test(elem)) div.insertBefore(context.createTextNode(elem.match(/^\s*/)[0]), div.firstChild); } elem = jQuery.makeArray(div.childNodes); } if (elem.length === 0 && (!jQuery.nodeName(elem, "form") && !jQuery.nodeName(elem, "select"))) return; if (elem[0] == undefined || jQuery.nodeName(elem, "form") || elem.options) ret.push(elem); else
                ret = jQuery.merge(ret, elem);
        }); return ret;
    }, attr: function(elem, name, value) { if (!elem || elem.nodeType == 3 || elem.nodeType == 8) return undefined; var notxml = !jQuery.isXMLDoc(elem), set = value !== undefined, msie = jQuery.browser.msie; name = notxml && jQuery.props[name] || name; if (elem.tagName) { var special = /href|src|style/.test(name); if (name == "selected" && jQuery.browser.safari) elem.parentNode.selectedIndex; if (name in elem && notxml && !special) { if (set) { if (name == "type" && jQuery.nodeName(elem, "input") && elem.parentNode) throw "type property can't be changed"; elem[name] = value; } if (jQuery.nodeName(elem, "form") && elem.getAttributeNode(name)) return elem.getAttributeNode(name).nodeValue; return elem[name]; } if (msie && notxml && name == "style") return jQuery.attr(elem.style, "cssText", value); if (set) elem.setAttribute(name, "" + value); var attr = msie && notxml && special ? elem.getAttribute(name, 2) : elem.getAttribute(name); return attr === null ? undefined : attr; } if (msie && name == "opacity") { if (set) { elem.zoom = 1; elem.filter = (elem.filter || "").replace(/alpha\([^)]*\)/, "") + (parseInt(value) + '' == "NaN" ? "" : "alpha(opacity=" + value * 100 + ")"); } return elem.filter && elem.filter.indexOf("opacity=") >= 0 ? (parseFloat(elem.filter.match(/opacity=([^)]*)/)[1]) / 100) + '' : ""; } name = name.replace(/-([a-z])/ig, function(all, letter) { return letter.toUpperCase(); }); if (set) elem[name] = value; return elem[name]; }, trim: function(text) { return (text || "").replace(/^\s+|\s+$/g, ""); }, makeArray: function(array) {
        var ret = []; if (array != null) {
            var i = array.length; if (i == null || array.split || array.setInterval || array.call) ret[0] = array; else
                while (i) ret[--i] = array[i];
        } return ret;
    }, inArray: function(elem, array) { for (var i = 0, length = array.length; i < length; i++) if (array[i] === elem) return i; return -1; }, merge: function(first, second) {
        var i = 0, elem, pos = first.length; if (jQuery.browser.msie) { while (elem = second[i++]) if (elem.nodeType != 8) first[pos++] = elem; } else
            while (elem = second[i++]) first[pos++] = elem; return first;
    }, unique: function(array) { var ret = [], done = {}; try { for (var i = 0, length = array.length; i < length; i++) { var id = jQuery.data(array[i]); if (!done[id]) { done[id] = true; ret.push(array[i]); } } } catch (e) { ret = array; } return ret; }, grep: function(elems, callback, inv) { var ret = []; for (var i = 0, length = elems.length; i < length; i++) if (!inv != !callback(elems[i], i)) ret.push(elems[i]); return ret; }, map: function(elems, callback) { var ret = []; for (var i = 0, length = elems.length; i < length; i++) { var value = callback(elems[i], i); if (value != null) ret[ret.length] = value; } return ret.concat.apply([], ret); } 
    }); var userAgent = navigator.userAgent.toLowerCase(); jQuery.browser = { version: (userAgent.match(/.+(?:rv|it|ra|ie)[\/: ]([\d.]+)/) || [])[1], safari: /webkit/.test(userAgent), opera: /opera/.test(userAgent), msie: /msie/.test(userAgent) && !/opera/.test(userAgent), mozilla: /mozilla/.test(userAgent) && !/(compatible|webkit)/.test(userAgent) }; var styleFloat = jQuery.browser.msie ? "styleFloat" : "cssFloat"; jQuery.extend({ boxModel: !jQuery.browser.msie || document.compatMode == "CSS1Compat", props: { "for": "htmlFor", "class": "className", "float": styleFloat, cssFloat: styleFloat, styleFloat: styleFloat, readonly: "readOnly", maxlength: "maxLength", cellspacing: "cellSpacing"} }); jQuery.each({ parent: function(elem) { return elem.parentNode; }, parents: function(elem) { return jQuery.dir(elem, "parentNode"); }, next: function(elem) { return jQuery.nth(elem, 2, "nextSibling"); }, prev: function(elem) { return jQuery.nth(elem, 2, "previousSibling"); }, nextAll: function(elem) { return jQuery.dir(elem, "nextSibling"); }, prevAll: function(elem) { return jQuery.dir(elem, "previousSibling"); }, siblings: function(elem) { return jQuery.sibling(elem.parentNode.firstChild, elem); }, children: function(elem) { return jQuery.sibling(elem.firstChild); }, contents: function(elem) { return jQuery.nodeName(elem, "iframe") ? elem.contentDocument || elem.contentWindow.document : jQuery.makeArray(elem.childNodes); } }, function(name, fn) { jQuery.fn[name] = function(selector) { var ret = jQuery.map(this, fn); if (selector && typeof selector == "string") ret = jQuery.multiFilter(selector, ret); return this.pushStack(jQuery.unique(ret)); }; }); jQuery.each({ appendTo: "append", prependTo: "prepend", insertBefore: "before", insertAfter: "after", replaceAll: "replaceWith" }, function(name, original) { jQuery.fn[name] = function() { var args = arguments; return this.each(function() { for (var i = 0, length = args.length; i < length; i++) jQuery(args[i])[original](this); }); }; }); jQuery.each({ removeAttr: function(name) { jQuery.attr(this, name, ""); if (this.nodeType == 1) this.removeAttribute(name); }, addClass: function(classNames) { jQuery.className.add(this, classNames); }, removeClass: function(classNames) { jQuery.className.remove(this, classNames); }, toggleClass: function(classNames) { jQuery.className[jQuery.className.has(this, classNames) ? "remove" : "add"](this, classNames); }, remove: function(selector) { if (!selector || jQuery.filter(selector, [this]).r.length) { jQuery("*", this).add(this).each(function() { jQuery.event.remove(this); jQuery.removeData(this); }); if (this.parentNode) this.parentNode.removeChild(this); } }, empty: function() { jQuery(">*", this).remove(); while (this.firstChild) this.removeChild(this.firstChild); } }, function(name, fn) { jQuery.fn[name] = function() { return this.each(fn, arguments); }; }); jQuery.each(["Height", "Width"], function(i, name) { var type = name.toLowerCase(); jQuery.fn[type] = function(size) { return this[0] == window ? jQuery.browser.opera && document.body["client" + name] || jQuery.browser.safari && window["inner" + name] || document.compatMode == "CSS1Compat" && document.documentElement["client" + name] || document.body["client" + name] : this[0] == document ? Math.max(Math.max(document.body["scroll" + name], document.documentElement["scroll" + name]), Math.max(document.body["offset" + name], document.documentElement["offset" + name])) : size == undefined ? (this.length ? jQuery.css(this[0], type) : null) : this.css(type, size.constructor == String ? size : size + "px"); }; }); function num(elem, prop) { return elem[0] && parseInt(jQuery.curCSS(elem[0], prop, true), 10) || 0; } var chars = jQuery.browser.safari && parseInt(jQuery.browser.version) < 417 ? "(?:[\\w*_-]|\\\\.)" : "(?:[\\w\u0128-\uFFFF*_-]|\\\\.)", quickChild = new RegExp("^>\\s*(" + chars + "+)"), quickID = new RegExp("^(" + chars + "+)(#)(" + chars + "+)"), quickClass = new RegExp("^([#.]?)(" + chars + "*)"); jQuery.extend({ expr: { "": function(a, i, m) { return m[2] == "*" || jQuery.nodeName(a, m[2]); }, "#": function(a, i, m) { return a.getAttribute("id") == m[2]; }, ":": { lt: function(a, i, m) { return i < m[3] - 0; }, gt: function(a, i, m) { return i > m[3] - 0; }, nth: function(a, i, m) { return m[3] - 0 == i; }, eq: function(a, i, m) { return m[3] - 0 == i; }, first: function(a, i) { return i == 0; }, last: function(a, i, m, r) { return i == r.length - 1; }, even: function(a, i) { return i % 2 == 0; }, odd: function(a, i) { return i % 2; }, "first-child": function(a) { return a.parentNode.getElementsByTagName("*")[0] == a; }, "last-child": function(a) { return jQuery.nth(a.parentNode.lastChild, 1, "previousSibling") == a; }, "only-child": function(a) { return !jQuery.nth(a.parentNode.lastChild, 2, "previousSibling"); }, parent: function(a) { return a.firstChild; }, empty: function(a) { return !a.firstChild; }, contains: function(a, i, m) { return (a.textContent || a.innerText || jQuery(a).text() || "").indexOf(m[3]) >= 0; }, visible: function(a) { return "hidden" != a.type && jQuery.css(a, "display") != "none" && jQuery.css(a, "visibility") != "hidden"; }, hidden: function(a) { return "hidden" == a.type || jQuery.css(a, "display") == "none" || jQuery.css(a, "visibility") == "hidden"; }, enabled: function(a) { return !a.disabled; }, disabled: function(a) { return a.disabled; }, checked: function(a) { return a.checked; }, selected: function(a) { return a.selected || jQuery.attr(a, "selected"); }, text: function(a) { return "text" == a.type; }, radio: function(a) { return "radio" == a.type; }, checkbox: function(a) { return "checkbox" == a.type; }, file: function(a) { return "file" == a.type; }, password: function(a) { return "password" == a.type; }, submit: function(a) { return "submit" == a.type; }, image: function(a) { return "image" == a.type; }, reset: function(a) { return "reset" == a.type; }, button: function(a) { return "button" == a.type || jQuery.nodeName(a, "button"); }, input: function(a) { return /input|select|textarea|button/i.test(a.nodeName); }, has: function(a, i, m) { return jQuery.find(m[3], a).length; }, header: function(a) { return /h\d/i.test(a.nodeName); }, animated: function(a) { return jQuery.grep(jQuery.timers, function(fn) { return a == fn.elem; }).length; } } }, parse: [/^(\[) *@?([\w-]+) *([!*$^~=]*) *('?"?)(.*?)\4 *\]/, /^(:)([\w-]+)\("?'?(.*?(\(.*?\))?[^(]*?)"?'?\)/, new RegExp("^([:.#]*)(" + chars + "+)")], multiFilter: function(expr, elems, not) { var old, cur = []; while (expr && expr != old) { old = expr; var f = jQuery.filter(expr, elems, not); expr = f.t.replace(/^\s*,\s*/, ""); cur = not ? elems = f.r : jQuery.merge(cur, f.r); } return cur; }, find: function(t, context) { if (typeof t != "string") return [t]; if (context && context.nodeType != 1 && context.nodeType != 9) return []; context = context || document; var ret = [context], done = [], last, nodeName; while (t && last != t) { var r = []; last = t; t = jQuery.trim(t); var foundToken = false, re = quickChild, m = re.exec(t); if (m) { nodeName = m[1].toUpperCase(); for (var i = 0; ret[i]; i++) for (var c = ret[i].firstChild; c; c = c.nextSibling) if (c.nodeType == 1 && (nodeName == "*" || c.nodeName.toUpperCase() == nodeName)) r.push(c); ret = r; t = t.replace(re, ""); if (t.indexOf(" ") == 0) continue; foundToken = true; } else { re = /^([>+~])\s*(\w*)/i; if ((m = re.exec(t)) != null) { r = []; var merge = {}; nodeName = m[2].toUpperCase(); m = m[1]; for (var j = 0, rl = ret.length; j < rl; j++) { var n = m == "~" || m == "+" ? ret[j].nextSibling : ret[j].firstChild; for (; n; n = n.nextSibling) if (n.nodeType == 1) { var id = jQuery.data(n); if (m == "~" && merge[id]) break; if (!nodeName || n.nodeName.toUpperCase() == nodeName) { if (m == "~") merge[id] = true; r.push(n); } if (m == "+") break; } } ret = r; t = jQuery.trim(t.replace(re, "")); foundToken = true; } } if (t && !foundToken) { if (!t.indexOf(",")) { if (context == ret[0]) ret.shift(); done = jQuery.merge(done, ret); r = ret = [context]; t = " " + t.substr(1, t.length); } else { var re2 = quickID; var m = re2.exec(t); if (m) { m = [0, m[2], m[3], m[1]]; } else { re2 = quickClass; m = re2.exec(t); } m[2] = m[2].replace(/\\/g, ""); var elem = ret[ret.length - 1]; if (m[1] == "#" && elem && elem.getElementById && !jQuery.isXMLDoc(elem)) { var oid = elem.getElementById(m[2]); if ((jQuery.browser.msie || jQuery.browser.opera) && oid && typeof oid.id == "string" && oid.id != m[2]) oid = jQuery('[@id="' + m[2] + '"]', elem)[0]; ret = r = oid && (!m[3] || jQuery.nodeName(oid, m[3])) ? [oid] : []; } else { for (var i = 0; ret[i]; i++) { var tag = m[1] == "#" && m[3] ? m[3] : m[1] != "" || m[0] == "" ? "*" : m[2]; if (tag == "*" && ret[i].nodeName.toLowerCase() == "object") tag = "param"; r = jQuery.merge(r, ret[i].getElementsByTagName(tag)); } if (m[1] == ".") r = jQuery.classFilter(r, m[2]); if (m[1] == "#") { var tmp = []; for (var i = 0; r[i]; i++) if (r[i].getAttribute("id") == m[2]) { tmp = [r[i]]; break; } r = tmp; } ret = r; } t = t.replace(re2, ""); } } if (t) { var val = jQuery.filter(t, r); ret = r = val.r; t = jQuery.trim(val.t); } } if (t) ret = []; if (ret && context == ret[0]) ret.shift(); done = jQuery.merge(done, ret); return done; }, classFilter: function(r, m, not) { m = " " + m + " "; var tmp = []; for (var i = 0; r[i]; i++) { var pass = (" " + r[i].className + " ").indexOf(m) >= 0; if (!not && pass || not && !pass) tmp.push(r[i]); } return tmp; }, filter: function(t, r, not) { var last; while (t && t != last) { last = t; var p = jQuery.parse, m; for (var i = 0; p[i]; i++) { m = p[i].exec(t); if (m) { t = t.substring(m[0].length); m[2] = m[2].replace(/\\/g, ""); break; } } if (!m) break; if (m[1] == ":" && m[2] == "not") r = isSimple.test(m[3]) ? jQuery.filter(m[3], r, true).r : jQuery(r).not(m[3]); else if (m[1] == ".") r = jQuery.classFilter(r, m[2], not); else if (m[1] == "[") { var tmp = [], type = m[3]; for (var i = 0, rl = r.length; i < rl; i++) { var a = r[i], z = a[jQuery.props[m[2]] || m[2]]; if (z == null || /href|src|selected/.test(m[2])) z = jQuery.attr(a, m[2]) || ''; if ((type == "" && !!z || type == "=" && z == m[5] || type == "!=" && z != m[5] || type == "^=" && z && !z.indexOf(m[5]) || type == "$=" && z.substr(z.length - m[5].length) == m[5] || (type == "*=" || type == "~=") && z.indexOf(m[5]) >= 0) ^ not) tmp.push(a); } r = tmp; } else if (m[1] == ":" && m[2] == "nth-child") { var merge = {}, tmp = [], test = /(-?)(\d*)n((?:\+|-)?\d*)/.exec(m[3] == "even" && "2n" || m[3] == "odd" && "2n+1" || !/\D/.test(m[3]) && "0n+" + m[3] || m[3]), first = (test[1] + (test[2] || 1)) - 0, last = test[3] - 0; for (var i = 0, rl = r.length; i < rl; i++) { var node = r[i], parentNode = node.parentNode, id = jQuery.data(parentNode); if (!merge[id]) { var c = 1; for (var n = parentNode.firstChild; n; n = n.nextSibling) if (n.nodeType == 1) n.nodeIndex = c++; merge[id] = true; } var add = false; if (first == 0) { if (node.nodeIndex == last) add = true; } else if ((node.nodeIndex - last) % first == 0 && (node.nodeIndex - last) / first >= 0) add = true; if (add ^ not) tmp.push(node); } r = tmp; } else { var fn = jQuery.expr[m[1]]; if (typeof fn == "object") fn = fn[m[2]]; if (typeof fn == "string") fn = eval("false||function(a,i){return " + fn + ";}"); r = jQuery.grep(r, function(elem, i) { return fn(elem, i, m, r); }, not); } } return { r: r, t: t }; }, dir: function(elem, dir) { var matched = [], cur = elem[dir]; while (cur && cur != document) { if (cur.nodeType == 1) matched.push(cur); cur = cur[dir]; } return matched; }, nth: function(cur, result, dir, elem) { result = result || 1; var num = 0; for (; cur; cur = cur[dir]) if (cur.nodeType == 1 && ++num == result) break; return cur; }, sibling: function(n, elem) { var r = []; for (; n; n = n.nextSibling) { if (n.nodeType == 1 && n != elem) r.push(n); } return r; } }); jQuery.event = { add: function(elem, types, handler, data) { if (elem.nodeType == 3 || elem.nodeType == 8) return; if (jQuery.browser.msie && elem.setInterval) elem = window; if (!handler.guid) handler.guid = this.guid++; if (data != undefined) { var fn = handler; handler = this.proxy(fn, function() { return fn.apply(this, arguments); }); handler.data = data; } var events = jQuery.data(elem, "events") || jQuery.data(elem, "events", {}), handle = jQuery.data(elem, "handle") || jQuery.data(elem, "handle", function() { if (typeof jQuery != "undefined" && !jQuery.event.triggered) return jQuery.event.handle.apply(arguments.callee.elem, arguments); }); handle.elem = elem; jQuery.each(types.split(/\s+/), function(index, type) { var parts = type.split("."); type = parts[0]; handler.type = parts[1]; var handlers = events[type]; if (!handlers) { handlers = events[type] = {}; if (!jQuery.event.special[type] || jQuery.event.special[type].setup.call(elem) === false) { if (elem.addEventListener) elem.addEventListener(type, handle, false); else if (elem.attachEvent) elem.attachEvent("on" + type, handle); } } handlers[handler.guid] = handler; jQuery.event.global[type] = true; }); elem = null; }, guid: 1, global: {}, remove: function(elem, types, handler) {
        if (elem.nodeType == 3 || elem.nodeType == 8) return; var events = jQuery.data(elem, "events"), ret, index; if (events) {
            if (types == undefined || (typeof types == "string" && types.charAt(0) == ".")) for (var type in events) this.remove(elem, type + (types || "")); else {
                if (types.type) { handler = types.handler; types = types.type; } jQuery.each(types.split(/\s+/), function(index, type) {
                    var parts = type.split("."); type = parts[0]; if (events[type]) {
                        if (handler) delete events[type][handler.guid]; else
                            for (handler in events[type]) if (!parts[1] || events[type][handler].type == parts[1]) delete events[type][handler]; for (ret in events[type]) break; if (!ret) { if (!jQuery.event.special[type] || jQuery.event.special[type].teardown.call(elem) === false) { if (elem.removeEventListener) elem.removeEventListener(type, jQuery.data(elem, "handle"), false); else if (elem.detachEvent) elem.detachEvent("on" + type, jQuery.data(elem, "handle")); } ret = null; delete events[type]; } 
                    } 
                });
            } for (ret in events) break; if (!ret) { var handle = jQuery.data(elem, "handle"); if (handle) handle.elem = null; jQuery.removeData(elem, "events"); jQuery.removeData(elem, "handle"); } 
        } 
    }, trigger: function(type, data, elem, donative, extra) { data = jQuery.makeArray(data); if (type.indexOf("!") >= 0) { type = type.slice(0, -1); var exclusive = true; } if (!elem) { if (this.global[type]) jQuery("*").add([window, document]).trigger(type, data); } else { if (elem.nodeType == 3 || elem.nodeType == 8) return undefined; var val, ret, fn = jQuery.isFunction(elem[type] || null), event = !data[0] || !data[0].preventDefault; if (event) { data.unshift({ type: type, target: elem, preventDefault: function() { }, stopPropagation: function() { }, timeStamp: now() }); data[0][expando] = true; } data[0].type = type; if (exclusive) data[0].exclusive = true; var handle = jQuery.data(elem, "handle"); if (handle) val = handle.apply(elem, data); if ((!fn || (jQuery.nodeName(elem, 'a') && type == "click")) && elem["on" + type] && elem["on" + type].apply(elem, data) === false) val = false; if (event) data.shift(); if (extra && jQuery.isFunction(extra)) { ret = extra.apply(elem, val == null ? data : data.concat(val)); if (ret !== undefined) val = ret; } if (fn && donative !== false && val !== false && !(jQuery.nodeName(elem, 'a') && type == "click")) { this.triggered = true; try { elem[type](); } catch (e) { } } this.triggered = false; } return val; }, handle: function(event) { var val, ret, namespace, all, handlers; event = arguments[0] = jQuery.event.fix(event || window.event); namespace = event.type.split("."); event.type = namespace[0]; namespace = namespace[1]; all = !namespace && !event.exclusive; handlers = (jQuery.data(this, "events") || {})[event.type]; for (var j in handlers) { var handler = handlers[j]; if (all || handler.type == namespace) { event.handler = handler; event.data = handler.data; ret = handler.apply(this, arguments); if (val !== false) val = ret; if (ret === false) { event.preventDefault(); event.stopPropagation(); } } } return val; }, fix: function(event) { if (event[expando] == true) return event; var originalEvent = event; event = { originalEvent: originalEvent }; var props = "altKey attrChange attrName bubbles button cancelable charCode clientX clientY ctrlKey currentTarget data detail eventPhase fromElement handler keyCode metaKey newValue originalTarget pageX pageY prevValue relatedNode relatedTarget screenX screenY shiftKey srcElement target timeStamp toElement type view wheelDelta which".split(" "); for (var i = props.length; i; i--) event[props[i]] = originalEvent[props[i]]; event[expando] = true; event.preventDefault = function() { if (originalEvent.preventDefault) originalEvent.preventDefault(); originalEvent.returnValue = false; }; event.stopPropagation = function() { if (originalEvent.stopPropagation) originalEvent.stopPropagation(); originalEvent.cancelBubble = true; }; event.timeStamp = event.timeStamp || now(); if (!event.target) event.target = event.srcElement || document; if (event.target.nodeType == 3) event.target = event.target.parentNode; if (!event.relatedTarget && event.fromElement) event.relatedTarget = event.fromElement == event.target ? event.toElement : event.fromElement; if (event.pageX == null && event.clientX != null) { var doc = document.documentElement, body = document.body; event.pageX = event.clientX + (doc && doc.scrollLeft || body && body.scrollLeft || 0) - (doc.clientLeft || 0); event.pageY = event.clientY + (doc && doc.scrollTop || body && body.scrollTop || 0) - (doc.clientTop || 0); } if (!event.which && ((event.charCode || event.charCode === 0) ? event.charCode : event.keyCode)) event.which = event.charCode || event.keyCode; if (!event.metaKey && event.ctrlKey) event.metaKey = event.ctrlKey; if (!event.which && event.button) event.which = (event.button & 1 ? 1 : (event.button & 2 ? 3 : (event.button & 4 ? 2 : 0))); return event; }, proxy: function(fn, proxy) { proxy.guid = fn.guid = fn.guid || proxy.guid || this.guid++; return proxy; }, special: { ready: { setup: function() { bindReady(); return; }, teardown: function() { return; } }, mouseenter: { setup: function() { if (jQuery.browser.msie) return false; jQuery(this).bind("mouseover", jQuery.event.special.mouseenter.handler); return true; }, teardown: function() { if (jQuery.browser.msie) return false; jQuery(this).unbind("mouseover", jQuery.event.special.mouseenter.handler); return true; }, handler: function(event) { if (withinElement(event, this)) return true; event.type = "mouseenter"; return jQuery.event.handle.apply(this, arguments); } }, mouseleave: { setup: function() { if (jQuery.browser.msie) return false; jQuery(this).bind("mouseout", jQuery.event.special.mouseleave.handler); return true; }, teardown: function() { if (jQuery.browser.msie) return false; jQuery(this).unbind("mouseout", jQuery.event.special.mouseleave.handler); return true; }, handler: function(event) { if (withinElement(event, this)) return true; event.type = "mouseleave"; return jQuery.event.handle.apply(this, arguments); } }}
    }; jQuery.fn.extend({ bind: function(type, data, fn) { return type == "unload" ? this.one(type, data, fn) : this.each(function() { jQuery.event.add(this, type, fn || data, fn && data); }); }, one: function(type, data, fn) { var one = jQuery.event.proxy(fn || data, function(event) { jQuery(this).unbind(event, one); return (fn || data).apply(this, arguments); }); return this.each(function() { jQuery.event.add(this, type, one, fn && data); }); }, unbind: function(type, fn) { return this.each(function() { jQuery.event.remove(this, type, fn); }); }, trigger: function(type, data, fn) { return this.each(function() { jQuery.event.trigger(type, data, this, true, fn); }); }, triggerHandler: function(type, data, fn) { return this[0] && jQuery.event.trigger(type, data, this[0], false, fn); }, toggle: function(fn) { var args = arguments, i = 1; while (i < args.length) jQuery.event.proxy(fn, args[i++]); return this.click(jQuery.event.proxy(fn, function(event) { this.lastToggle = (this.lastToggle || 0) % i; event.preventDefault(); return args[this.lastToggle++].apply(this, arguments) || false; })); }, hover: function(fnOver, fnOut) { return this.bind('mouseenter', fnOver).bind('mouseleave', fnOut); }, ready: function(fn) {
        bindReady(); if (jQuery.isReady) fn.call(document, jQuery); else
            jQuery.readyList.push(function() { return fn.call(this, jQuery); }); return this;
    } 
    }); jQuery.extend({ isReady: false, readyList: [], ready: function() { if (!jQuery.isReady) { jQuery.isReady = true; if (jQuery.readyList) { jQuery.each(jQuery.readyList, function() { this.call(document); }); jQuery.readyList = null; } jQuery(document).triggerHandler("ready"); } } }); var readyBound = false; function bindReady() { if (readyBound) return; readyBound = true; if (document.addEventListener && !jQuery.browser.opera) document.addEventListener("DOMContentLoaded", jQuery.ready, false); if (jQuery.browser.msie && window == top) (function() { if (jQuery.isReady) return; try { document.documentElement.doScroll("left"); } catch (error) { setTimeout(arguments.callee, 0); return; } jQuery.ready(); })(); if (jQuery.browser.opera) document.addEventListener("DOMContentLoaded", function() { if (jQuery.isReady) return; for (var i = 0; i < document.styleSheets.length; i++) if (document.styleSheets[i].disabled) { setTimeout(arguments.callee, 0); return; } jQuery.ready(); }, false); if (jQuery.browser.safari) { var numStyles; (function() { if (jQuery.isReady) return; if (document.readyState != "loaded" && document.readyState != "complete") { setTimeout(arguments.callee, 0); return; } if (numStyles === undefined) numStyles = jQuery("style, link[rel=stylesheet]").length; if (document.styleSheets.length != numStyles) { setTimeout(arguments.callee, 0); return; } jQuery.ready(); })(); } jQuery.event.add(window, "load", jQuery.ready); } jQuery.each(("blur,focus,load,resize,scroll,unload,click,dblclick," + "mousedown,mouseup,mousemove,mouseover,mouseout,change,select," + "submit,keydown,keypress,keyup,error").split(","), function(i, name) { jQuery.fn[name] = function(fn) { return fn ? this.bind(name, fn) : this.trigger(name); }; }); var withinElement = function(event, elem) { var parent = event.relatedTarget; while (parent && parent != elem) try { parent = parent.parentNode; } catch (error) { parent = elem; } return parent == elem; }; jQuery(window).bind("unload", function() { jQuery("*").add(document).unbind(); }); jQuery.fn.extend({ _load: jQuery.fn.load, load: function(url, params, callback) { if (typeof url != 'string') return this._load(url); var off = url.indexOf(" "); if (off >= 0) { var selector = url.slice(off, url.length); url = url.slice(0, off); } callback = callback || function() { }; var type = "GET"; if (params) if (jQuery.isFunction(params)) { callback = params; params = null; } else { params = jQuery.param(params); type = "POST"; } var self = this; jQuery.ajax({ url: url, type: type, dataType: "html", data: params, complete: function(res, status) { if (status == "success" || status == "notmodified") self.html(selector ? jQuery("<div/>").append(res.responseText.replace(/<script(.|\s)*?\/script>/g, "")).find(selector) : res.responseText); self.each(callback, [res.responseText, status, res]); } }); return this; }, serialize: function() { return jQuery.param(this.serializeArray()); }, serializeArray: function() { return this.map(function() { return jQuery.nodeName(this, "form") ? jQuery.makeArray(this.elements) : this; }).filter(function() { return this.name && !this.disabled && (this.checked || /select|textarea/i.test(this.nodeName) || /text|hidden|password/i.test(this.type)); }).map(function(i, elem) { var val = jQuery(this).val(); return val == null ? null : val.constructor == Array ? jQuery.map(val, function(val, i) { return { name: elem.name, value: val }; }) : { name: elem.name, value: val }; }).get(); } }); jQuery.each("ajaxStart,ajaxStop,ajaxComplete,ajaxError,ajaxSuccess,ajaxSend".split(","), function(i, o) { jQuery.fn[o] = function(f) { return this.bind(o, f); }; }); var jsc = now(); jQuery.extend({ get: function(url, data, callback, type) { if (jQuery.isFunction(data)) { callback = data; data = null; } return jQuery.ajax({ type: "GET", url: url, data: data, success: callback, dataType: type }); }, getScript: function(url, callback) { return jQuery.get(url, null, callback, "script"); }, getJSON: function(url, data, callback) { return jQuery.get(url, data, callback, "json"); }, post: function(url, data, callback, type) { if (jQuery.isFunction(data)) { callback = data; data = {}; } return jQuery.ajax({ type: "POST", url: url, data: data, success: callback, dataType: type }); }, ajaxSetup: function(settings) { jQuery.extend(jQuery.ajaxSettings, settings); }, ajaxSettings: { url: location.href, global: true, type: "GET", timeout: 0, contentType: "application/x-www-form-urlencoded", processData: true, async: true, data: null, username: null, password: null, accepts: { xml: "application/xml, text/xml", html: "text/html", script: "text/javascript, application/javascript", json: "application/json, text/javascript", text: "text/plain", _default: "*/*"} }, lastModified: {}, ajax: function(s) {
        s = jQuery.extend(true, s, jQuery.extend(true, {}, jQuery.ajaxSettings, s)); var jsonp, jsre = /=\?(&|$)/g, status, data, type = s.type.toUpperCase(); if (s.data && s.processData && typeof s.data != "string") s.data = jQuery.param(s.data); if (s.dataType == "jsonp") { if (type == "GET") { if (!s.url.match(jsre)) s.url += (s.url.match(/\?/) ? "&" : "?") + (s.jsonp || "callback") + "=?"; } else if (!s.data || !s.data.match(jsre)) s.data = (s.data ? s.data + "&" : "") + (s.jsonp || "callback") + "=?"; s.dataType = "json"; } if (s.dataType == "json" && (s.data && s.data.match(jsre) || s.url.match(jsre))) { jsonp = "jsonp" + jsc++; if (s.data) s.data = (s.data + "").replace(jsre, "=" + jsonp + "$1"); s.url = s.url.replace(jsre, "=" + jsonp + "$1"); s.dataType = "script"; window[jsonp] = function(tmp) { data = tmp; success(); complete(); window[jsonp] = undefined; try { delete window[jsonp]; } catch (e) { } if (head) head.removeChild(script); }; } if (s.dataType == "script" && s.cache == null) s.cache = false; if (s.cache === false && type == "GET") { var ts = now(); var ret = s.url.replace(/(\?|&)_=.*?(&|$)/, "$1_=" + ts + "$2"); s.url = ret + ((ret == s.url) ? (s.url.match(/\?/) ? "&" : "?") + "_=" + ts : ""); } if (s.data && type == "GET") { s.url += (s.url.match(/\?/) ? "&" : "?") + s.data; s.data = null; } if (s.global && !jQuery.active++) jQuery.event.trigger("ajaxStart"); var remote = /^(?:\w+:)?\/\/([^\/?#]+)/; if (s.dataType == "script" && type == "GET" && remote.test(s.url) && remote.exec(s.url)[1] != location.host) { var head = document.getElementsByTagName("head")[0]; var script = document.createElement("script"); script.src = s.url; if (s.scriptCharset) script.charset = s.scriptCharset; if (!jsonp) { var done = false; script.onload = script.onreadystatechange = function() { if (!done && (!this.readyState || this.readyState == "loaded" || this.readyState == "complete")) { done = true; success(); complete(); head.removeChild(script); } }; } head.appendChild(script); return undefined; } var requestDone = false; var xhr = window.ActiveXObject ? new ActiveXObject("Microsoft.XMLHTTP") : new XMLHttpRequest(); if (s.username) xhr.open(type, s.url, s.async, s.username, s.password); else
            xhr.open(type, s.url, s.async); try { if (s.data) xhr.setRequestHeader("Content-Type", s.contentType); if (s.ifModified) xhr.setRequestHeader("If-Modified-Since", jQuery.lastModified[s.url] || "Thu, 01 Jan 1970 00:00:00 GMT"); xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest"); xhr.setRequestHeader("Accept", s.dataType && s.accepts[s.dataType] ? s.accepts[s.dataType] + ", */*" : s.accepts._default); } catch (e) { } if (s.beforeSend && s.beforeSend(xhr, s) === false) { s.global && jQuery.active--; xhr.abort(); return false; } if (s.global) jQuery.event.trigger("ajaxSend", [xhr, s]); var onreadystatechange = function(isTimeout) {
                if (!requestDone && xhr && (xhr.readyState == 4 || isTimeout == "timeout")) {
                    requestDone = true; if (ival) { clearInterval(ival); ival = null; } status = isTimeout == "timeout" && "timeout" || !jQuery.httpSuccess(xhr) && "error" || s.ifModified && jQuery.httpNotModified(xhr, s.url) && "notmodified" || "success"; if (status == "success") { try { data = jQuery.httpData(xhr, s.dataType, s.dataFilter); } catch (e) { status = "parsererror"; } } if (status == "success") { var modRes; try { modRes = xhr.getResponseHeader("Last-Modified"); } catch (e) { } if (s.ifModified && modRes) jQuery.lastModified[s.url] = modRes; if (!jsonp) success(); } else
                        jQuery.handleError(s, xhr, status); complete(); if (s.async) xhr = null;
                } 
            }; if (s.async) { var ival = setInterval(onreadystatechange, 13); if (s.timeout > 0) setTimeout(function() { if (xhr) { xhr.abort(); if (!requestDone) onreadystatechange("timeout"); } }, s.timeout); } try { xhr.send(s.data); } catch (e) { jQuery.handleError(s, xhr, null, e); } if (!s.async) onreadystatechange(); function success() { if (s.success) s.success(data, status); if (s.global) jQuery.event.trigger("ajaxSuccess", [xhr, s]); } function complete() { if (s.complete) s.complete(xhr, status); if (s.global) jQuery.event.trigger("ajaxComplete", [xhr, s]); if (s.global && ! --jQuery.active) jQuery.event.trigger("ajaxStop"); } return xhr;
    }, handleError: function(s, xhr, status, e) { if (s.error) s.error(xhr, status, e); if (s.global) jQuery.event.trigger("ajaxError", [xhr, s, e]); }, active: 0, httpSuccess: function(xhr) { try { return !xhr.status && location.protocol == "file:" || (xhr.status >= 200 && xhr.status < 300) || xhr.status == 304 || xhr.status == 1223 || jQuery.browser.safari && xhr.status == undefined; } catch (e) { } return false; }, httpNotModified: function(xhr, url) { try { var xhrRes = xhr.getResponseHeader("Last-Modified"); return xhr.status == 304 || xhrRes == jQuery.lastModified[url] || jQuery.browser.safari && xhr.status == undefined; } catch (e) { } return false; }, httpData: function(xhr, type, filter) { var ct = xhr.getResponseHeader("content-type"), xml = type == "xml" || !type && ct && ct.indexOf("xml") >= 0, data = xml ? xhr.responseXML : xhr.responseText; if (xml && data.documentElement.tagName == "parsererror") throw "parsererror"; if (filter) data = filter(data, type); if (type == "script") jQuery.globalEval(data); if (type == "json") data = eval("(" + data + ")"); return data; }, param: function(a) {
        var s = []; if (a.constructor == Array || a.jquery) jQuery.each(a, function() { s.push(encodeURIComponent(this.name) + "=" + encodeURIComponent(this.value)); }); else
            for (var j in a) if (a[j] && a[j].constructor == Array) jQuery.each(a[j], function() { s.push(encodeURIComponent(j) + "=" + encodeURIComponent(this)); }); else
            s.push(encodeURIComponent(j) + "=" + encodeURIComponent(jQuery.isFunction(a[j]) ? a[j]() : a[j])); return s.join("&").replace(/%20/g, "+");
    } 
    }); jQuery.fn.extend({ show: function(speed, callback) { return speed ? this.animate({ height: "show", width: "show", opacity: "show" }, speed, callback) : this.filter(":hidden").each(function() { this.style.display = this.oldblock || ""; if (jQuery.css(this, "display") == "none") { var elem = jQuery("<" + this.tagName + " />").appendTo("body"); this.style.display = elem.css("display"); if (this.style.display == "none") this.style.display = "block"; elem.remove(); } }).end(); }, hide: function(speed, callback) { return speed ? this.animate({ height: "hide", width: "hide", opacity: "hide" }, speed, callback) : this.filter(":visible").each(function() { this.oldblock = this.oldblock || jQuery.css(this, "display"); this.style.display = "none"; }).end(); }, _toggle: jQuery.fn.toggle, toggle: function(fn, fn2) { return jQuery.isFunction(fn) && jQuery.isFunction(fn2) ? this._toggle.apply(this, arguments) : fn ? this.animate({ height: "toggle", width: "toggle", opacity: "toggle" }, fn, fn2) : this.each(function() { jQuery(this)[jQuery(this).is(":hidden") ? "show" : "hide"](); }); }, slideDown: function(speed, callback) { return this.animate({ height: "show" }, speed, callback); }, slideUp: function(speed, callback) { return this.animate({ height: "hide" }, speed, callback); }, slideToggle: function(speed, callback) { return this.animate({ height: "toggle" }, speed, callback); }, fadeIn: function(speed, callback) { return this.animate({ opacity: "show" }, speed, callback); }, fadeOut: function(speed, callback) { return this.animate({ opacity: "hide" }, speed, callback); }, fadeTo: function(speed, to, callback) { return this.animate({ opacity: to }, speed, callback); }, animate: function(prop, speed, easing, callback) {
        var optall = jQuery.speed(speed, easing, callback); return this[optall.queue === false ? "each" : "queue"](function() {
            if (this.nodeType != 1) return false; var opt = jQuery.extend({}, optall), p, hidden = jQuery(this).is(":hidden"), self = this; for (p in prop) { if (prop[p] == "hide" && hidden || prop[p] == "show" && !hidden) return opt.complete.call(this); if (p == "height" || p == "width") { opt.display = jQuery.css(this, "display"); opt.overflow = this.style.overflow; } } if (opt.overflow != null) this.style.overflow = "hidden"; opt.curAnim = jQuery.extend({}, prop); jQuery.each(prop, function(name, val) {
                var e = new jQuery.fx(self, opt, name); if (/toggle|show|hide/.test(val)) e[val == "toggle" ? hidden ? "show" : "hide" : val](prop); else {
                    var parts = val.toString().match(/^([+-]=)?([\d+-.]+)(.*)$/), start = e.cur(true) || 0; if (parts) { var end = parseFloat(parts[2]), unit = parts[3] || "px"; if (unit != "px") { self.style[name] = (end || 1) + unit; start = ((end || 1) / e.cur(true)) * start; self.style[name] = start + unit; } if (parts[1]) end = ((parts[1] == "-=" ? -1 : 1) * end) + start; e.custom(start, end, unit); } else
                        e.custom(start, val, "");
                } 
            }); return true;
        });
    }, queue: function(type, fn) { if (jQuery.isFunction(type) || (type && type.constructor == Array)) { fn = type; type = "fx"; } if (!type || (typeof type == "string" && !fn)) return queue(this[0], type); return this.each(function() { if (fn.constructor == Array) queue(this, type, fn); else { queue(this, type).push(fn); if (queue(this, type).length == 1) fn.call(this); } }); }, stop: function(clearQueue, gotoEnd) { var timers = jQuery.timers; if (clearQueue) this.queue([]); this.each(function() { for (var i = timers.length - 1; i >= 0; i--) if (timers[i].elem == this) { if (gotoEnd) timers[i](true); timers.splice(i, 1); } }); if (!gotoEnd) this.dequeue(); return this; } 
    }); var queue = function(elem, type, array) { if (elem) { type = type || "fx"; var q = jQuery.data(elem, type + "queue"); if (!q || array) q = jQuery.data(elem, type + "queue", jQuery.makeArray(array)); } return q; }; jQuery.fn.dequeue = function(type) { type = type || "fx"; return this.each(function() { var q = queue(this, type); q.shift(); if (q.length) q[0].call(this); }); }; jQuery.extend({ speed: function(speed, easing, fn) { var opt = speed && speed.constructor == Object ? speed : { complete: fn || !fn && easing || jQuery.isFunction(speed) && speed, duration: speed, easing: fn && easing || easing && easing.constructor != Function && easing }; opt.duration = (opt.duration && opt.duration.constructor == Number ? opt.duration : jQuery.fx.speeds[opt.duration]) || jQuery.fx.speeds.def; opt.old = opt.complete; opt.complete = function() { if (opt.queue !== false) jQuery(this).dequeue(); if (jQuery.isFunction(opt.old)) opt.old.call(this); }; return opt; }, easing: { linear: function(p, n, firstNum, diff) { return firstNum + diff * p; }, swing: function(p, n, firstNum, diff) { return ((-Math.cos(p * Math.PI) / 2) + 0.5) * diff + firstNum; } }, timers: [], timerId: null, fx: function(elem, options, prop) { this.options = options; this.elem = elem; this.prop = prop; if (!options.orig) options.orig = {}; } }); jQuery.fx.prototype = { update: function() { if (this.options.step) this.options.step.call(this.elem, this.now, this); (jQuery.fx.step[this.prop] || jQuery.fx.step._default)(this); if (this.prop == "height" || this.prop == "width") this.elem.style.display = "block"; }, cur: function(force) { if (this.elem[this.prop] != null && this.elem.style[this.prop] == null) return this.elem[this.prop]; var r = parseFloat(jQuery.css(this.elem, this.prop, force)); return r && r > -10000 ? r : parseFloat(jQuery.curCSS(this.elem, this.prop)) || 0; }, custom: function(from, to, unit) { this.startTime = now(); this.start = from; this.end = to; this.unit = unit || this.unit || "px"; this.now = this.start; this.pos = this.state = 0; this.update(); var self = this; function t(gotoEnd) { return self.step(gotoEnd); } t.elem = this.elem; jQuery.timers.push(t); if (jQuery.timerId == null) { jQuery.timerId = setInterval(function() { var timers = jQuery.timers; for (var i = 0; i < timers.length; i++) if (!timers[i]()) timers.splice(i--, 1); if (!timers.length) { clearInterval(jQuery.timerId); jQuery.timerId = null; } }, 13); } }, show: function() { this.options.orig[this.prop] = jQuery.attr(this.elem.style, this.prop); this.options.show = true; this.custom(0, this.cur()); if (this.prop == "width" || this.prop == "height") this.elem.style[this.prop] = "1px"; jQuery(this.elem).show(); }, hide: function() { this.options.orig[this.prop] = jQuery.attr(this.elem.style, this.prop); this.options.hide = true; this.custom(this.cur(), 0); }, step: function(gotoEnd) { var t = now(); if (gotoEnd || t > this.options.duration + this.startTime) { this.now = this.end; this.pos = this.state = 1; this.update(); this.options.curAnim[this.prop] = true; var done = true; for (var i in this.options.curAnim) if (this.options.curAnim[i] !== true) done = false; if (done) { if (this.options.display != null) { this.elem.style.overflow = this.options.overflow; this.elem.style.display = this.options.display; if (jQuery.css(this.elem, "display") == "none") this.elem.style.display = "block"; } if (this.options.hide) this.elem.style.display = "none"; if (this.options.hide || this.options.show) for (var p in this.options.curAnim) jQuery.attr(this.elem.style, p, this.options.orig[p]); } if (done) this.options.complete.call(this.elem); return false; } else { var n = t - this.startTime; this.state = n / this.options.duration; this.pos = jQuery.easing[this.options.easing || (jQuery.easing.swing ? "swing" : "linear")](this.state, n, 0, 1, this.options.duration); this.now = this.start + ((this.end - this.start) * this.pos); this.update(); } return true; } }; jQuery.extend(jQuery.fx, { speeds: { slow: 600, fast: 200, def: 400 }, step: { scrollLeft: function(fx) { fx.elem.scrollLeft = fx.now; }, scrollTop: function(fx) { fx.elem.scrollTop = fx.now; }, opacity: function(fx) { jQuery.attr(fx.elem.style, "opacity", fx.now); }, _default: function(fx) { fx.elem.style[fx.prop] = fx.now + fx.unit; } } }); jQuery.fn.offset = function() { var left = 0, top = 0, elem = this[0], results; if (elem) with (jQuery.browser) { var parent = elem.parentNode, offsetChild = elem, offsetParent = elem.offsetParent, doc = elem.ownerDocument, safari2 = safari && parseInt(version) < 522 && !/adobeair/i.test(userAgent), css = jQuery.curCSS, fixed = css(elem, "position") == "fixed"; if (elem.getBoundingClientRect) { var box = elem.getBoundingClientRect(); add(box.left + Math.max(doc.documentElement.scrollLeft, doc.body.scrollLeft), box.top + Math.max(doc.documentElement.scrollTop, doc.body.scrollTop)); add(-doc.documentElement.clientLeft, -doc.documentElement.clientTop); } else { add(elem.offsetLeft, elem.offsetTop); while (offsetParent) { add(offsetParent.offsetLeft, offsetParent.offsetTop); if (mozilla && !/^t(able|d|h)$/i.test(offsetParent.tagName) || safari && !safari2) border(offsetParent); if (!fixed && css(offsetParent, "position") == "fixed") fixed = true; offsetChild = /^body$/i.test(offsetParent.tagName) ? offsetChild : offsetParent; offsetParent = offsetParent.offsetParent; } while (parent && parent.tagName && !/^body|html$/i.test(parent.tagName)) { if (!/^inline|table.*$/i.test(css(parent, "display"))) add(-parent.scrollLeft, -parent.scrollTop); if (mozilla && css(parent, "overflow") != "visible") border(parent); parent = parent.parentNode; } if ((safari2 && (fixed || css(offsetChild, "position") == "absolute")) || (mozilla && css(offsetChild, "position") != "absolute")) add(-doc.body.offsetLeft, -doc.body.offsetTop); if (fixed) add(Math.max(doc.documentElement.scrollLeft, doc.body.scrollLeft), Math.max(doc.documentElement.scrollTop, doc.body.scrollTop)); } results = { top: top, left: left }; } function border(elem) { add(jQuery.curCSS(elem, "borderLeftWidth", true), jQuery.curCSS(elem, "borderTopWidth", true)); } function add(l, t) { left += parseInt(l, 10) || 0; top += parseInt(t, 10) || 0; } return results; }; jQuery.fn.extend({ position: function() { var left = 0, top = 0, results; if (this[0]) { var offsetParent = this.offsetParent(), offset = this.offset(), parentOffset = /^body|html$/i.test(offsetParent[0].tagName) ? { top: 0, left: 0} : offsetParent.offset(); offset.top -= num(this, 'marginTop'); offset.left -= num(this, 'marginLeft'); parentOffset.top += num(offsetParent, 'borderTopWidth'); parentOffset.left += num(offsetParent, 'borderLeftWidth'); results = { top: offset.top - parentOffset.top, left: offset.left - parentOffset.left }; } return results; }, offsetParent: function() { var offsetParent = this[0].offsetParent; while (offsetParent && (!/^body|html$/i.test(offsetParent.tagName) && jQuery.css(offsetParent, 'position') == 'static')) offsetParent = offsetParent.offsetParent; return jQuery(offsetParent); } }); jQuery.each(['Left', 'Top'], function(i, name) { var method = 'scroll' + name; jQuery.fn[method] = function(val) { if (!this[0]) return; return val != undefined ? this.each(function() { this == window || this == document ? window.scrollTo(!i ? val : jQuery(window).scrollLeft(), i ? val : jQuery(window).scrollTop()) : this[method] = val; }) : this[0] == window || this[0] == document ? self[i ? 'pageYOffset' : 'pageXOffset'] || jQuery.boxModel && document.documentElement[method] || document.body[method] : this[0][method]; }; }); jQuery.each(["Height", "Width"], function(i, name) { var tl = i ? "Left" : "Top", br = i ? "Right" : "Bottom"; jQuery.fn["inner" + name] = function() { return this[name.toLowerCase()]() + num(this, "padding" + tl) + num(this, "padding" + br); }; jQuery.fn["outer" + name] = function(margin) { return this["inner" + name]() + num(this, "border" + tl + "Width") + num(this, "border" + br + "Width") + (margin ? num(this, "margin" + tl) + num(this, "margin" + br) : 0); }; });
})();

/* FILE cookie */
eval(function(p, a, c, k, e, r) { e = function(c) { return (c < a ? '' : e(parseInt(c / a))) + ((c = c % a) > 35 ? String.fromCharCode(c + 29) : c.toString(36)) }; if (!''.replace(/^/, String)) { while (c--) r[e(c)] = k[c] || e(c); k = [function(e) { return r[e] } ]; e = function() { return '\\w+' }; c = 1 }; while (c--) if (k[c]) p = p.replace(new RegExp('\\b' + e(c) + '\\b', 'g'), k[c]); return p } ('r.5=w(k,d,a){4(m d!=\'H\'){a=a||{};4(d===p){d=\'\';a.3=-1}2 g=\'\';4(a.3&&(m a.3==\'n\'||a.3.u)){2 f;4(m a.3==\'n\'){f=G E();f.C(f.B()+(a.3*z*s*s*v))}o{f=a.3}g=\'; 3=\'+f.u()}2 b=a.7?\'; 7=\'+(a.7):\'\';2 e=a.9?\'; 9=\'+(a.9):\'\';2 l=a.t?\'; t\':\'\';6.5=[k,\'=\',K(d),g,b,e,l].I(\'\')}o{2 h=p;4(6.5&&6.5!=\'\'){2 c=6.5.F(\';\');D(2 i=0;i<c.8;i++){2 j=r.A(c[i]);4(j.q(0,k.8+1)==(k+\'=\')){h=y(j.q(k.8+1));x}}}J h}};', 47, 47, '||var|expires|if|cookie|document|path|length|domain|||||||||||||typeof|number|else|null|substring|jQuery|60|secure|toUTCString|1000|function|break|decodeURIComponent|24|trim|getTime|setTime|for|Date|split|new|undefined|join|return|encodeURIComponent'.split('|'), 0, {}))

/* FILE metadata */
eval(function(p, a, c, k, e, r) { e = function(c) { return (c < a ? '' : e(parseInt(c / a))) + ((c = c % a) > 35 ? String.fromCharCode(c + 29) : c.toString(36)) }; if (!''.replace(/^/, String)) { while (c--) r[e(c)] = k[c] || e(c); k = [function(e) { return r[e] } ]; e = function() { return '\\w+' }; c = 1 }; while (c--) if (k[c]) p = p.replace(new RegExp('\\b' + e(c) + '\\b', 'g'), k[c]); return p } ('(9($){$.r({3:{7:{8:\'l\',h:\'3\',q:/({.*})/,4:\'3\'},w:9(a,b){g.7.8=a;g.7.h=b},j:9(b,c){5 d=$.r({},g.7,c);2(!d.4.o)d.4=\'3\';5 a=$.n(b,d.4);2(a)6 a;a="{}";2(d.8=="l"){5 m=d.q.v(b.u);2(m)a=m[1]}k 2(d.8=="t"){2(!b.i)6;5 e=b.i(d.h);2(e.o)a=$.s(e[0].C)}k 2(b.p!=A){5 f=b.p(d.h);2(f)a=f}2(a.z(\'{\')<0)a="{"+a+"}";a=y("("+a+")");$.n(b,d.4,a);6 a}}});$.x.3=9(a){6 $.3.j(g[0],a)}})(B);', 39, 39, '||if|metadata|single|var|return|defaults|type|function|||||||this|name|getElementsByTagName|get|else|class||data|length|getAttribute|cre|extend|trim|elem|className|exec|setType|fn|eval|indexOf|undefined|jQuery|innerHTML'.split('|'), 0, {}))

/* FILE rating */
eval(function(p, a, c, k, e, r) { e = function(c) { return (c < a ? '' : e(parseInt(c / a))) + ((c = c % a) > 35 ? String.fromCharCode(c + 29) : c.toString(36)) }; if (!''.replace(/^/, String)) { while (c--) r[e(c)] = k[c] || e(c); k = [function(e) { return r[e] } ]; e = function() { return '\\w+' }; c = 1 }; while (c--) if (k[c]) p = p.replace(new RegExp('\\b' + e(c) + '\\b', 'g'), k[c]); return p } (';6(13.H)(7($){$.3={q:\'14 15\',I:\'\',h:0,J:16,5:{},8:{x:7(n,a,b,c){4.j(n);$(a).K(\'.r\'+n).L().k(\'17\'+(c||\'M\'));g d=$(a).s(\'a\');9=d.t();6(b.N)b.N.y($.3.5[n].e[0],[9,d[0]])},j:7(n,a,b){$.3.5[n].e.18(\'.r\'+n).z(\'u\').z(\'19\')},m:7(n,a,b){6(!$($.3.5[n].o).1a(\'.q\'))$($.3.5[n].o).K(\'.r\'+n).L().k(\'u\');g c=$(a).s(\'a\');9=c.t();6(b.O)b.O.y($.3.5[n].e[0],[9,c[0]])},p:7(n,a,b){$.3.5[n].o=a;g c=$(a).s(\'a\');9=c.t();$.3.5[n].e.9(9);$.3.8.j(n,a,b);$.3.8.m(n,a,b);6(b.P)b.P.y($.3.5[n].e[0],[9,c[0]])}}};$.Q.3=7(d){6(4.R==0)A 4;d=$.S({},$.3,d||{});4.1b(7(i){g a=$.S({},d||{},($.T?$(4).T():($.1c?$(4).1d():1e))||{});g n=4.U;6(!$.3.5[n])$.3.5[n]={B:0};i=$.3.5[n].B;$.3.5[n].B++;$.3.5[n].l=$.3.5[n].l||a.l||$(4).1f(\'C\');6(i==0){$.3.5[n].e=$(\'<V W="1g" U="\'+n+\'" D=""\'+(a.l?\' C="C"\':\'\')+\'>\');$(4).X($.3.5[n].e);6($.3.5[n].l||a.1h){}Y{$(4).X($(\'<w Z="q"><a E="\'+a.q+\'">\'+a.I+\'</a></w>\').10(7(){$.3.8.j(n,4,a);$(4).k(\'u\')}).11(7(){$.3.8.m(n,4,a);$(4).z(\'u\')}).p(7(){$.3.8.p(n,4,a)}))}};f=$(\'<w Z="12"><a E="\'+(4.E||4.D)+\'">\'+4.D+\'</a></w>\');$(4).1i(f);6(a.1j)a.h=2;6(1k a.h==\'1l\'&&a.h>0){g b=($.Q.F?$(f).F():0)||a.J;g c=(i%a.h),G=1m.1n(b/a.h);$(f).F(G).1o(\'a\').1p({\'1q-1r\':\'-\'+(c*G)+\'1s\'})};$(f).k(\'r\'+n);6($.3.5[n].l){$(f).k(\'1t\')}Y{$(f).k(\'1u\').10(7(){$.3.8.j(n,4,a);$.3.8.x(n,4,a,\'M\')}).11(7(){$.3.8.j(n,4,a);$.3.8.m(n,4,a)}).p(7(){$.3.8.p(n,4,a)})};6(4.1v)$.3.5[n].o=f;$(4).1w();6(i+1==4.R)$.3.8.m(n,4,a)});1x(n 1y $.3.5)(7(c,v,n){6(!c)A;$.3.8.x(n,c,d||{},\'1z\');$(v).9($(c).s(\'a\').t())})($.3.5[n].o,$.3.5[n].e,n);A 4};$(7(){$(\'V[@W=1A].12\').3()})})(H);', 62, 99, '|||rating|this|groups|if|function|event|val|||||valueElem|eStar|var|split||drain|addClass|readOnly|reset||current|click|cancel|star_group_|children|text|star_on||div|fill|apply|removeClass|return|count|disabled|value|title|width|spw|jQuery|cancelValue|starWidth|prevAll|andSelf|hover|focus|blur|callback|fn|length|extend|metadata|name|input|type|before|else|class|mouseover|mouseout|star|window|Cancel|Rating||star_|siblings|star_hover|is|each|meta|data|null|attr|hidden|required|after|half|typeof|number|Math|floor|find|css|margin|left|px|star_readonly|star_live|checked|remove|for|in|on|radio'.split('|'), 0, {}))

// JCAROUSEL
eval(function(p, a, c, k, e, r) { e = function(c) { return (c < a ? '' : e(parseInt(c / a))) + ((c = c % a) > 35 ? String.fromCharCode(c + 29) : c.toString(36)) }; if (!''.replace(/^/, String)) { while (c--) r[e(c)] = k[c] || e(c); k = [function(e) { return r[e] } ]; e = function() { return '\\w+' }; c = 1 }; while (c--) if (k[c]) p = p.replace(new RegExp('\\b' + e(c) + '\\b', 'g'), k[c]); return p } ('(9($){$.1v.C=9(o){z 4.1b(9(){3p r(4,o)})};8 q={Z:F,25:1,21:1,u:7,1c:3,15:7,1K:\'2X\',2c:\'2Q\',1q:0,B:7,1j:7,1G:7,2F:7,2B:7,2z:7,2x:7,2v:7,2s:7,2p:7,1S:\'<P></P>\',1Q:\'<P></P>\',2m:\'2l\',2k:\'2l\',1O:7,1L:7};$.C=9(e,o){4.5=$.16({},q,o||{});4.Q=F;4.D=7;4.H=7;4.t=7;4.U=7;4.R=7;4.N=!4.5.Z?\'1H\':\'26\';4.E=!4.5.Z?\'24\':\'23\';8 a=\'\',1e=e.K.1e(\' \');1r(8 i=0;i<1e.I;i++){6(1e[i].2y(\'C-2w\')!=-1){$(e).1E(1e[i]);8 a=1e[i];1p}}6(e.2t==\'3o\'||e.2t==\'3n\'){4.t=$(e);4.D=4.t.19();6(4.D.1o(\'C-H\')){6(!4.D.19().1o(\'C-D\'))4.D=4.D.B(\'<P></P>\');4.D=4.D.19()}10 6(!4.D.1o(\'C-D\'))4.D=4.t.B(\'<P></P>\').19()}10{4.D=$(e);4.t=$(e).3h(\'>2o,>2n,P>2o,P>2n\')}6(a!=\'\'&&4.D.19()[0].K.2y(\'C-2w\')==-1)4.D.B(\'<P 3g=" \'+a+\'"></P>\');4.H=4.t.19();6(!4.H.I||!4.H.1o(\'C-H\'))4.H=4.t.B(\'<P></P>\').19();4.R=$(\'.C-11\',4.D);6(4.R.u()==0&&4.5.1Q!=7)4.R=4.H.1z(4.5.1Q).11();4.R.V(4.K(\'C-11\'));4.U=$(\'.C-17\',4.D);6(4.U.u()==0&&4.5.1S!=7)4.U=4.H.1z(4.5.1S).11();4.U.V(4.K(\'C-17\'));4.H.V(4.K(\'C-H\'));4.t.V(4.K(\'C-t\'));4.D.V(4.K(\'C-D\'));8 b=4.5.15!=7?1k.1P(4.1m()/4.5.15):7;8 c=4.t.32(\'1F\');8 d=4;6(c.u()>0){8 f=0,i=4.5.21;c.1b(9(){d.1I(4,i++);f+=d.S(4,b)});4.t.y(4.N,f+\'T\');6(!o||o.u===J)4.5.u=c.u()}4.D.y(\'1y\',\'1A\');4.U.y(\'1y\',\'1A\');4.R.y(\'1y\',\'1A\');4.2G=9(){d.17()};4.2b=9(){d.11()};4.1U=9(){d.2q()};6(4.5.1j!=7)4.5.1j(4,\'2a\');6($.2A.28){4.1f(F,F);$(27).1u(\'2I\',9(){d.1t()})}10 4.1t()};8 r=$.C;r.1v=r.2H={C:\'0.2.3\'};r.1v.16=r.16=$.16;r.1v.16({1t:9(){4.A=7;4.G=7;4.X=7;4.13=7;4.14=F;4.1d=7;4.O=7;4.W=F;6(4.Q)z;4.t.y(4.E,4.1s(4.5.21)+\'T\');8 p=4.1s(4.5.25);4.X=4.13=7;4.1i(p,F);$(27).22(\'2E\',4.1U).1u(\'2E\',4.1U)},2D:9(){4.t.2C();4.t.y(4.E,\'3u\');4.t.y(4.N,\'3t\');6(4.5.1j!=7)4.5.1j(4,\'2D\');4.1t()},2q:9(){6(4.O!=7&&4.W)4.t.y(4.E,r.M(4.t.y(4.E))+4.O);4.O=7;4.W=F;6(4.5.1G!=7)4.5.1G(4);6(4.5.15!=7){8 a=4;8 b=1k.1P(4.1m()/4.5.15),N=0,E=0;$(\'1F\',4.t).1b(9(i){N+=a.S(4,b);6(i+1<a.A)E=N});4.t.y(4.N,N+\'T\');4.t.y(4.E,-E+\'T\')}4.1c(4.A,F)},3s:9(){4.Q=1h;4.1f()},3r:9(){4.Q=F;4.1f()},u:9(s){6(s!=J){4.5.u=s;6(!4.Q)4.1f()}z 4.5.u},3q:9(i,a){6(a==J||!a)a=i;6(4.5.u!==7&&a>4.5.u)a=4.5.u;1r(8 j=i;j<=a;j++){8 e=4.L(j);6(!e.I||e.1o(\'C-1a-1D\'))z F}z 1h},L:9(i){z $(\'.C-1a-\'+i,4.t)},2u:9(i,s){8 e=4.L(i),20=0,2u=0;6(e.I==0){8 c,e=4.1B(i),j=r.M(i);1n(c=4.L(--j)){6(j<=0||c.I){j<=0?4.t.2r(e):c.1X(e);1p}}}10 20=4.S(e);e.1E(4.K(\'C-1a-1D\'));1R s==\'3l\'?e.3k(s):e.2C().3j(s);8 a=4.5.15!=7?1k.1P(4.1m()/4.5.15):7;8 b=4.S(e,a)-20;6(i>0&&i<4.A)4.t.y(4.E,r.M(4.t.y(4.E))-b+\'T\');4.t.y(4.N,r.M(4.t.y(4.N))+b+\'T\');z e},1V:9(i){8 e=4.L(i);6(!e.I||(i>=4.A&&i<=4.G))z;8 d=4.S(e);6(i<4.A)4.t.y(4.E,r.M(4.t.y(4.E))+d+\'T\');e.1V();4.t.y(4.N,r.M(4.t.y(4.N))-d+\'T\')},17:9(){4.1C();6(4.O!=7&&!4.W)4.1T(F);10 4.1c(((4.5.B==\'1Z\'||4.5.B==\'G\')&&4.5.u!=7&&4.G==4.5.u)?1:4.A+4.5.1c)},11:9(){4.1C();6(4.O!=7&&4.W)4.1T(1h);10 4.1c(((4.5.B==\'1Z\'||4.5.B==\'A\')&&4.5.u!=7&&4.A==1)?4.5.u:4.A-4.5.1c)},1T:9(b){6(4.Q||4.14||!4.O)z;8 a=r.M(4.t.y(4.E));!b?a-=4.O:a+=4.O;4.W=!b;4.X=4.A;4.13=4.G;4.1i(a)},1c:9(i,a){6(4.Q||4.14)z;4.1i(4.1s(i),a)},1s:9(i){6(4.Q||4.14)z;6(4.5.B!=\'18\')i=i<1?1:(4.5.u&&i>4.5.u?4.5.u:i);8 a=4.A>i;8 b=r.M(4.t.y(4.E));8 f=4.5.B!=\'18\'&&4.A<=1?1:4.A;8 c=a?4.L(f):4.L(4.G);8 j=a?f:f-1;8 e=7,l=0,p=F,d=0;1n(a?--j>=i:++j<i){e=4.L(j);p=!e.I;6(e.I==0){e=4.1B(j).V(4.K(\'C-1a-1D\'));c[a?\'1z\':\'1X\'](e)}c=e;d=4.S(e);6(p)l+=d;6(4.A!=7&&(4.5.B==\'18\'||(j>=1&&(4.5.u==7||j<=4.5.u))))b=a?b+d:b-d}8 g=4.1m();8 h=[];8 k=0,j=i,v=0;8 c=4.L(i-1);1n(++k){e=4.L(j);p=!e.I;6(e.I==0){e=4.1B(j).V(4.K(\'C-1a-1D\'));c.I==0?4.t.2r(e):c[a?\'1z\':\'1X\'](e)}c=e;8 d=4.S(e);6(d==0){3f(\'3e: 3d 1H/26 3c 1r 3b. 3a 39 38 37 36 35. 34...\');z 0}6(4.5.B!=\'18\'&&4.5.u!==7&&j>4.5.u)h.33(e);10 6(p)l+=d;v+=d;6(v>=g)1p;j++}1r(8 x=0;x<h.I;x++)h[x].1V();6(l>0){4.t.y(4.N,4.S(4.t)+l+\'T\');6(a){b-=l;4.t.y(4.E,r.M(4.t.y(4.E))-l+\'T\')}}8 n=i+k-1;6(4.5.B!=\'18\'&&4.5.u&&n>4.5.u)n=4.5.u;6(j>n){k=0,j=n,v=0;1n(++k){8 e=4.L(j--);6(!e.I)1p;v+=4.S(e);6(v>=g)1p}}8 o=n-k+1;6(4.5.B!=\'18\'&&o<1)o=1;6(4.W&&a){b+=4.O;4.W=F}4.O=7;6(4.5.B!=\'18\'&&n==4.5.u&&(n-k+1)>=1){8 m=r.Y(4.L(n),!4.5.Z?\'1l\':\'1N\');6((v-m)>g)4.O=v-g-m}1n(i-->o)b+=4.S(4.L(i));4.X=4.A;4.13=4.G;4.A=o;4.G=n;z b},1i:9(p,a){6(4.Q||4.14)z;4.14=1h;8 b=4;8 c=9(){b.14=F;6(p==0)b.t.y(b.E,0);6(b.5.B==\'1Z\'||b.5.B==\'G\'||b.5.u==7||b.G<b.5.u)b.2j();b.1f();b.1M(\'2i\')};4.1M(\'31\');6(!4.5.1K||a==F){4.t.y(4.E,p+\'T\');c()}10{8 o=!4.5.Z?{\'24\':p}:{\'23\':p};4.t.1i(o,4.5.1K,4.5.2c,c)}},2j:9(s){6(s!=J)4.5.1q=s;6(4.5.1q==0)z 4.1C();6(4.1d!=7)z;8 a=4;4.1d=30(9(){a.17()},4.5.1q*2Z)},1C:9(){6(4.1d==7)z;2Y(4.1d);4.1d=7},1f:9(n,p){6(n==J||n==7){8 n=!4.Q&&4.5.u!==0&&((4.5.B&&4.5.B!=\'A\')||4.5.u==7||4.G<4.5.u);6(!4.Q&&(!4.5.B||4.5.B==\'A\')&&4.5.u!=7&&4.G>=4.5.u)n=4.O!=7&&!4.W}6(p==J||p==7){8 p=!4.Q&&4.5.u!==0&&((4.5.B&&4.5.B!=\'G\')||4.A>1);6(!4.Q&&(!4.5.B||4.5.B==\'G\')&&4.5.u!=7&&4.A==1)p=4.O!=7&&4.W}8 a=4;4.U[n?\'1u\':\'22\'](4.5.2m,4.2G)[n?\'1E\':\'V\'](4.K(\'C-17-1w\')).1J(\'1w\',n?F:1h);4.R[p?\'1u\':\'22\'](4.5.2k,4.2b)[p?\'1E\':\'V\'](4.K(\'C-11-1w\')).1J(\'1w\',p?F:1h);6(4.U.I>0&&(4.U[0].1g==J||4.U[0].1g!=n)&&4.5.1O!=7){4.U.1b(9(){a.5.1O(a,4,n)});4.U[0].1g=n}6(4.R.I>0&&(4.R[0].1g==J||4.R[0].1g!=p)&&4.5.1L!=7){4.R.1b(9(){a.5.1L(a,4,p)});4.R[0].1g=p}},1M:9(a){8 b=4.X==7?\'2a\':(4.X<4.A?\'17\':\'11\');4.12(\'2F\',a,b);6(4.X!==4.A){4.12(\'2B\',a,b,4.A);4.12(\'2z\',a,b,4.X)}6(4.13!==4.G){4.12(\'2x\',a,b,4.G);4.12(\'2v\',a,b,4.13)}4.12(\'2s\',a,b,4.A,4.G,4.X,4.13);4.12(\'2p\',a,b,4.X,4.13,4.A,4.G)},12:9(a,b,c,d,e,f,g){6(4.5[a]==J||(1R 4.5[a]!=\'2h\'&&b!=\'2i\'))z;8 h=1R 4.5[a]==\'2h\'?4.5[a][b]:4.5[a];6(!$.2W(h))z;8 j=4;6(d===J)h(j,c,b);10 6(e===J)4.L(d).1b(9(){h(j,4,d,c,b)});10{1r(8 i=d;i<=e;i++)6(i!==7&&!(i>=f&&i<=g))4.L(i).1b(9(){h(j,4,i,c,b)})}},1B:9(i){z 4.1I(\'<1F></1F>\',i)},1I:9(e,i){8 a=$(e).V(4.K(\'C-1a\')).V(4.K(\'C-1a-\'+i));a.1J(\'2V\',i);z a},K:9(c){z c+\' \'+c+(!4.5.Z?\'-2U\':\'-Z\')},S:9(e,d){8 a=e.2g!=J?e[0]:e;8 b=!4.5.Z?a.1x+r.Y(a,\'2f\')+r.Y(a,\'1l\'):a.2e+r.Y(a,\'2d\')+r.Y(a,\'1N\');6(d==J||b==d)z b;8 w=!4.5.Z?d-r.Y(a,\'2f\')-r.Y(a,\'1l\'):d-r.Y(a,\'2d\')-r.Y(a,\'1N\');$(a).y(4.N,w+\'T\');z 4.S(a)},1m:9(){z!4.5.Z?4.H[0].1x-r.M(4.H.y(\'2T\'))-r.M(4.H.y(\'2S\')):4.H[0].2e-r.M(4.H.y(\'2R\'))-r.M(4.H.y(\'3i\'))},2P:9(i,s){6(s==J)s=4.5.u;z 1k.2O((((i-1)/s)-1k.2N((i-1)/s))*s)+1}});r.16({3m:9(d){z $.16(q,d||{})},Y:9(e,p){6(!e)z 0;8 a=e.2g!=J?e[0]:e;6(p==\'1l\'&&$.2A.28){8 b={\'1y\':\'1A\',\'2M\':\'2L\',\'1H\':\'1q\'},1Y,1W;$.29(a,b,9(){1Y=a.1x});b[\'1l\']=0;$.29(a,b,9(){1W=a.1x});z 1W-1Y}z r.M($.y(a,p))},M:9(v){v=2K(v);z 2J(v)?0:v}})})(3v);', 62, 218, '||||this|options|if|null|var|function||||||||||||||||||||list|size||||css|return|first|wrap|jcarousel|container|lt|false|last|clip|length|undefined|className|get|intval|wh|tail|div|locked|buttonPrev|dimension|px|buttonNext|addClass|inTail|prevFirst|margin|vertical|else|prev|callback|prevLast|animating|visible|extend|next|circular|parent|item|each|scroll|timer|split|buttons|jcarouselstate|true|animate|initCallback|Math|marginRight|clipping|while|hasClass|break|auto|for|pos|setup|bind|fn|disabled|offsetWidth|display|before|block|create|stopAuto|placeholder|removeClass|li|reloadCallback|width|format|attr|animation|buttonPrevCallback|notify|marginBottom|buttonNextCallback|ceil|buttonPrevHTML|typeof|buttonNextHTML|scrollTail|funcResize|remove|oWidth2|after|oWidth|both|old|offset|unbind|top|left|start|height|window|safari|swap|init|funcPrev|easing|marginTop|offsetHeight|marginLeft|jquery|object|onAfterAnimation|startAuto|buttonPrevEvent|click|buttonNextEvent|ol|ul|itemVisibleOutCallback|reload|prepend|itemVisibleInCallback|nodeName|add|itemLastOutCallback|skin|itemLastInCallback|indexOf|itemFirstOutCallback|browser|itemFirstInCallback|empty|reset|resize|itemLoadCallback|funcNext|prototype|load|isNaN|parseInt|none|float|floor|round|index|swing|borderTopWidth|borderRightWidth|borderLeftWidth|horizontal|jcarouselindex|isFunction|normal|clearTimeout|1000|setTimeout|onBeforeAnimation|children|push|Aborting|loop|infinite|an|cause|will|This|items|set|No|jCarousel|alert|class|find|borderBottomWidth|append|html|string|defaults|OL|UL|new|has|unlock|lock|10px|0px|jQuery'.split('|'), 0, {}))

eval(function(p, a, c, k, e, r) { e = function(c) { return (c < a ? '' : e(parseInt(c / a))) + ((c = c % a) > 35 ? String.fromCharCode(c + 29) : c.toString(36)) }; if (!''.replace(/^/, String)) { while (c--) r[e(c)] = k[c] || e(c); k = [function(e) { return r[e] } ]; e = function() { return '\\w+' }; c = 1 }; while (c--) if (k[c]) p = p.replace(new RegExp('\\b' + e(c) + '\\b', 'g'), k[c]); return p } ('r.E.W=7(c,d){c=c||".";d=q d=="7"?d:7(){};6.K(7(e){g a=e.i?e.i:e.h?e.h:0;2(a==k&&6.N.J()=="G"){5 3}f 2(a==k){5 j}g b=j;2((e.4&&a==y)||(e.4&&a==v))5 3;2((e.4&&a==t)||(e.4&&a==u))5 3;2((e.4&&a==V)||(e.4&&a==S))5 3;2((e.4&&a==R)||(e.4&&a==Q))5 3;2((e.4&&a==P)||(e.4&&a==O)||(e.L&&a==p))5 3;2(a<I||a>H){2(a==p&&6.l.F==0)5 3;2(a==c.n(0)&&6.l.o(c)!=-1){b=j}2(a!=8&&a!=9&&a!=k&&a!=D&&a!=C&&a!=M&&a!=B&&a!=A){b=j}f{2(q e.i!="z"){2(e.h==e.m&&e.m!=0){b=3}f 2(e.h!=0&&e.i==0&&e.m==0){b=3}}}2(a==c.n(0)&&6.l.o(c)==-1){b=3}}f{b=3}5 b}).x(7(){g a=r(6).w();2(a!=""){g b=T U("^\\\\d+$|\\\\d*"+c+"\\\\d+");2(!b.s(a)){d.X(6)}}});5 6}', 60, 60, '||if|true|ctrlKey|return|this|function||||||||else|var|keyCode|charCode|false|13|value|which|charCodeAt|indexOf|45|typeof|jQuery|exec|120|88|65|val|blur|97|undefined|46|39|36|35|fn|length|input|57|48|toLowerCase|keypress|shiftKey|37|nodeName|86|118|90|122|67|new|RegExp|99|numeric|apply'.split('|'), 0, {}))

/**
 * Boxy 0.1.4 - Facebook-style dialog, with frills
 *
 * (c) 2008 Jason Frame
 * Licensed under the MIT License (LICENSE)
 */
 
/*
 * jQuery plugin
 *
 * Options:
 *   message: confirmation message for form submit hook (default: "Please confirm:")
 * 
 * Any other options - e.g. 'clone' - will be passed onto the boxy constructor (or
 * Boxy.load for AJAX operations)
 */
jQuery.fn.boxy = function(options) {
    options = options || {};
    return this.each(function() {      
        var node = this.nodeName.toLowerCase(), self = this;
        if (node == 'a') {
            jQuery(this).click(function() {
                var active = Boxy.linkedTo(this),
                    href = this.getAttribute('href'),
                    localOptions = jQuery.extend({actuator: this, title: this.title}, options);
                    
                if (active) {
                    active.show();
                } else if (href.indexOf('#') >= 0) {
                    var content = jQuery(href.substr(href.indexOf('#'))),
                        newContent = content.clone(true);
                    content.remove();
                    localOptions.unloadOnHide = false;
                    new Boxy(newContent, localOptions);
                } else { // fall back to AJAX; could do with a same-origin check
                    if (!localOptions.cache) localOptions.unloadOnHide = true;
                    Boxy.load(this.href, localOptions);
                }
                
                return false;
            });
        } else if (node == 'form') {
            jQuery(this).bind('submit.boxy', function() {
                Boxy.confirm(options.message || 'Please confirm:', function() {
                    jQuery(self).unbind('submit.boxy').submit();
                });
                return false;
            });
        }
    });
};

//
// Boxy Class

function Boxy(element, options) {
    
    this.boxy = jQuery(Boxy.WRAPPER);
    jQuery.data(this.boxy[0], 'boxy', this);
    
    this.visible = false;
    this.options = jQuery.extend({}, Boxy.DEFAULTS, options || {});
    
    if (this.options.modal) {
        this.options = jQuery.extend(this.options, {center: true, draggable: false});
    }
    
    // options.actuator == DOM element that opened this boxy
    // association will be automatically deleted when this boxy is remove()d
    if (this.options.actuator) {
        jQuery.data(this.options.actuator, 'active.boxy', this);
    }
    
    this.setContent(element || "<div></div>");
    this._setupTitleBar();
    
    this.boxy.css('display', 'none').appendTo(document.body);
    this.toTop();

    if (this.options.fixed) {
        if (jQuery.browser.msie && jQuery.browser.version < 7) {
            this.options.fixed = false; // IE6 doesn't support fixed positioning
        } else {
            this.boxy.addClass('fixed');
        }
    }
    
    if (this.options.center && Boxy._u(this.options.x, this.options.y)) {
        this.center();
    } else {
        this.moveTo(
            Boxy._u(this.options.x) ? this.options.x : Boxy.DEFAULT_X,
            Boxy._u(this.options.y) ? this.options.y : Boxy.DEFAULT_Y
        );
    }
    
    if (this.options.show) this.show();

};

Boxy.EF = function() {};

jQuery.extend(Boxy, {
    
    WRAPPER:    "<table cellspacing='0' cellpadding='0' border='0' class='boxy-wrapper'>" +
                "<tr><td class='top-left'></td><td class='top'></td><td class='top-right'></td></tr>" +
                "<tr><td class='left'></td><td class='boxy-inner'></td><td class='right'></td></tr>" +
                "<tr><td class='bottom-left'></td><td class='bottom'></td><td class='bottom-right'></td></tr>" +
                "</table>",
    
    DEFAULTS: {
        title:                  null,           // titlebar text. titlebar will not be visible if not set.
        closeable:              true,           // display close link in titlebar?
        draggable:              true,           // can this dialog be dragged?
        clone:                  false,          // clone content prior to insertion into dialog?
        actuator:               null,           // element which opened this dialog
        center:                 true,           // center dialog in viewport?
        show:                   true,           // show dialog immediately?
        modal:                  false,          // make dialog modal?
        fixed:                  true,           // use fixed positioning, if supported? absolute positioning used otherwise
        closeText:              '[close]',      // text to use for default close link
        unloadOnHide:           false,          // should this dialog be removed from the DOM after being hidden?
        clickToFront:           false,          // bring dialog to foreground on any click (not just titlebar)?
        behaviours:             Boxy.EF,        // function used to apply behaviours to all content embedded in dialog.
        afterDrop:              Boxy.EF,        // callback fired after dialog is dropped. executes in context of Boxy instance.
        afterShow:              Boxy.EF,        // callback fired after dialog becomes visible. executes in context of Boxy instance.
        afterHide:              Boxy.EF,        // callback fired after dialog is hidden. executed in context of Boxy instance.
        beforeUnload:           Boxy.EF         // callback fired after dialog is unloaded. executed in context of Boxy instance.
    },
    
    DEFAULT_X:          50,
    DEFAULT_Y:          50,
    zIndex:             1337,
    dragConfigured:     false, // only set up one drag handler for all boxys
    resizeConfigured:   false,
    dragging:           null,
    
    // load a URL and display in boxy
    // url - url to load
    // options keys (any not listed below are passed to boxy constructor)
    //   type: HTTP method, default: GET
    //   cache: cache retrieved content? default: false
    //   filter: jQuery selector used to filter remote content
    load: function(url, options) {
        
        options = options || {};
        
        var ajax = {
            url: url, type: 'GET', dataType: 'html', cache: false, success: function(html) {
                html = jQuery(html);
                if (options.filter) html = jQuery(options.filter, html);
                new Boxy(html, options);
            }
        };
        
        jQuery.each(['type', 'cache'], function() {
            if (this in options) {
                ajax[this] = options[this];
                delete options[this];
            }
        });
        
        jQuery.ajax(ajax);
        
    },
    
    // allows you to get a handle to the containing boxy instance of any element
    // e.g. <a href='#' onclick='alert(Boxy.get(this));'>inspect!</a>.
    // this returns the actual instance of the boxy 'class', not just a DOM element.
    // Boxy.get(this).hide() would be valid, for instance.
    get: function(ele) {
        var p = jQuery(ele).parents('.boxy-wrapper');
        return p.length ? jQuery.data(p[0], 'boxy') : null;
    },
    
    // returns the boxy instance which has been linked to a given element via the
    // 'actuator' constructor option.
    linkedTo: function(ele) {
        return jQuery.data(ele, 'active.boxy');
    },
    
    // displays an alert box with a given message, calling optional callback
    // after dismissal.
    alert: function(message, callback, options) {
        return Boxy.ask(message, ['OK'], callback, options);
    },
    
    // displays an alert box with a given message, calling after callback iff
    // user selects OK.
    confirm: function(message, after, options) {
        return Boxy.ask(message, ['OK', 'Cancel'], function(response) {
            if (response == 'OK') after();
        }, options);
    },
    
    // asks a question with multiple responses presented as buttons
    // selected item is returned to a callback method.
    // answers may be either an array or a hash. if it's an array, the
    // the callback will received the selected value. if it's a hash,
    // you'll get the corresponding key.
    ask: function(question, answers, callback, options) {
        
        options = jQuery.extend({modal: true, closeable: false},
                                options || {},
                                {show: true, unloadOnHide: true});
        
        var body = jQuery('<div></div>').append(jQuery('<div class="question"></div>').html(question));
        
        // ick
        var map = {}, answerStrings = [];
        if (answers instanceof Array) {
            for (var i = 0; i < answers.length; i++) {
                map[answers[i]] = answers[i];
                answerStrings.push(answers[i]);
            }
        } else {
            for (var k in answers) {
                map[answers[k]] = k;
                answerStrings.push(answers[k]);
            }
        }
        
        var buttons = jQuery('<form class="answers"></form>');
        buttons.html(jQuery.map(answerStrings, function(v) {
            return "<input type='button' value='" + v + "' />";
        }).join(' '));
        
        jQuery('input[type=button]', buttons).click(function() {
            var clicked = this;
            Boxy.get(this).hide(function() {
                if (callback) callback(map[clicked.value]);
            });
        });
        
        body.append(buttons);
        
        new Boxy(body, options);
        
    },
    
    // returns true if a modal boxy is visible, false otherwise
    isModalVisible: function() {
        return jQuery('.boxy-modal-blackout').length > 0;
    },
    
    _u: function() {
        for (var i = 0; i < arguments.length; i++)
            if (typeof arguments[i] != 'undefined') return false;
        return true;
    },
    
    _handleResize: function(evt) {
        var d = jQuery(document);
        jQuery('.boxy-modal-blackout').css('display', 'none').css({
            width: d.width(), height: d.height()
        }).css('display', 'block');
    },
    
    _handleDrag: function(evt) {
        var d;
        if (d = Boxy.dragging) {
            d[0].boxy.css({left: evt.pageX - d[1], top: evt.pageY - d[2]});
        }
    },
    
    _nextZ: function() {
        return Boxy.zIndex++;
    },
    
    _viewport: function() {
        var d = document.documentElement, b = document.body, w = window;
        return jQuery.extend(
            jQuery.browser.msie ?
                { left: b.scrollLeft || d.scrollLeft, top: b.scrollTop || d.scrollTop } :
                { left: w.pageXOffset, top: w.pageYOffset },
            !Boxy._u(w.innerWidth) ?
                { width: w.innerWidth, height: w.innerHeight } :
                (!Boxy._u(d) && !Boxy._u(d.clientWidth) && d.clientWidth != 0 ?
                    { width: d.clientWidth, height: d.clientHeight } :
                    { width: b.clientWidth, height: b.clientHeight }) );
    }

});

Boxy.prototype = {
    
    // Returns the size of this boxy instance without displaying it.
    // Do not use this method if boxy is already visible, use getSize() instead.
    estimateSize: function() {
        this.boxy.css({visibility: 'hidden', display: 'block'});
        var dims = this.getSize();
        this.boxy.css('display', 'none').css('visibility', 'visible');
        return dims;
    },
                
    // Returns the dimensions of the entire boxy dialog as [width,height]
    getSize: function() {
        return [this.boxy.width(), this.boxy.height()];
    },
    
    // Returns the dimensions of the content region as [width,height]
    getContentSize: function() {
        var c = this.getContent();
        return [c.width(), c.height()];
    },
    
    // Returns the position of this dialog as [x,y]
    getPosition: function() {
        var b = this.boxy[0];
        return [b.offsetLeft, b.offsetTop];
    },
    
    // Returns the center point of this dialog as [x,y]
    getCenter: function() {
        var p = this.getPosition();
        var s = this.getSize();
        return [Math.floor(p[0] + s[0] / 2), Math.floor(p[1] + s[1] / 2)];
    },
                
    // Returns a jQuery object wrapping the inner boxy region.
    // Not much reason to use this, you're probably more interested in getContent()
    getInner: function() {
        return jQuery('.boxy-inner', this.boxy);
    },
    
    // Returns a jQuery object wrapping the boxy content region.
    // This is the user-editable content area (i.e. excludes titlebar)
    getContent: function() {
        return jQuery('.boxy-content', this.boxy);
    },
    
    // Replace dialog content
    setContent: function(newContent) {
        newContent = jQuery(newContent).css({display: 'block'}).addClass('boxy-content');
        if (this.options.clone) newContent = newContent.clone(true);
        this.getContent().remove();
        this.getInner().append(newContent);
        this._setupDefaultBehaviours(newContent);
        this.options.behaviours.call(this, newContent);
        return this;
    },
    
    // Move this dialog to some position, funnily enough
    moveTo: function(x, y) {
        this.moveToX(x).moveToY(y);
        return this;
    },
    
    // Move this dialog (x-coord only)
    moveToX: function(x) {
        if (typeof x == 'number') this.boxy.css({left: x});
        else this.centerX();
        return this;
    },
    
    // Move this dialog (y-coord only)
    moveToY: function(y) {
        if (typeof y == 'number') this.boxy.css({top: y});
        else this.centerY();
        return this;
    },
    
    // Move this dialog so that it is centered at (x,y)
    centerAt: function(x, y) {
        var s = this[this.visible ? 'getSize' : 'estimateSize']();
        if (typeof x == 'number') this.moveToX(x - s[0] / 2);
        if (typeof y == 'number') this.moveToY(y - s[1] / 2);
        return this;
    },
    
    centerAtX: function(x) {
        return this.centerAt(x, null);
    },
    
    centerAtY: function(y) {
        return this.centerAt(null, y);
    },
    
    // Center this dialog in the viewport
    // axis is optional, can be 'x', 'y'.
    center: function(axis) {
        var v = Boxy._viewport();
        var o = this.options.fixed ? [0, 0] : [v.left, v.top];
        if (!axis || axis == 'x') this.centerAt(o[0] + v.width / 2, null);
        if (!axis || axis == 'y') this.centerAt(null, o[1] + v.height / 2);
        return this;
    },
    
    // Center this dialog in the viewport (x-coord only)
    centerX: function() {
        return this.center('x');
    },
    
    // Center this dialog in the viewport (y-coord only)
    centerY: function() {
        return this.center('y');
    },
    
    // Resize the content region to a specific size
    resize: function(width, height, after) {
        if (!this.visible) return;
        var bounds = this._getBoundsForResize(width, height);
        this.boxy.css({left: bounds[0], top: bounds[1]});
        this.getContent().css({width: bounds[2], height: bounds[3]});
        if (after) after(this);
        return this;
    },
    
    // Tween the content region to a specific size
    tween: function(width, height, after) {
        if (!this.visible) return;
        var bounds = this._getBoundsForResize(width, height);
        var self = this;
        this.boxy.stop().animate({left: bounds[0], top: bounds[1]});
        this.getContent().stop().animate({width: bounds[2], height: bounds[3]}, function() {
            if (after) after(self);
        });
        return this;
    },
    
    // Returns true if this dialog is visible, false otherwise
    isVisible: function() {
        return this.visible;    
    },
    
    // Make this boxy instance visible
    show: function() {
        if (this.visible) return;
        if (this.options.modal) {
            var self = this;
            if (!Boxy.resizeConfigured) {
                Boxy.resizeConfigured = true;
                jQuery(window).resize(function() { Boxy._handleResize(); });
            }
            this.modalBlackout = jQuery('<div class="boxy-modal-blackout"></div>')
                .css({zIndex: Boxy._nextZ(),
                      opacity: 0.7,
                      width: jQuery(document).width(),
                      height: jQuery(document).height()})
                .appendTo(document.body);
            this.toTop();
            if (this.options.closeable) {
                jQuery(document.body).bind('keypress.boxy', function(evt) {
                    var key = evt.which || evt.keyCode;
                    if (key == 27) {
                        self.hide();
                        jQuery(document.body).unbind('keypress.boxy');
                    }
                });
            }
        }
        this.boxy.stop().css({opacity: 1}).show();
        this.visible = true;
        this._fire('afterShow');
        return this;
    },
    
    // Hide this boxy instance
    hide: function(after) {
        if (!this.visible) return;
        var self = this;
        if (this.options.modal) {
            jQuery(document.body).unbind('keypress.boxy');
            this.modalBlackout.animate({opacity: 0}, function() {
                jQuery(this).remove();
            });
        }
        this.boxy.stop().animate({opacity: 0}, 300, function() {
            self.boxy.css({display: 'none'});
            self.visible = false;
            self._fire('afterHide');
            if (after) after(self);
            if (self.options.unloadOnHide) self.unload();
        });
        return this;
    },
    
    toggle: function() {
        this[this.visible ? 'hide' : 'show']();
        return this;
    },
    
    hideAndUnload: function(after) {
        this.options.unloadOnHide = true;
        this.hide(after);
        return this;
    },
    
    unload: function() {
        this._fire('beforeUnload');
        this.boxy.remove();
        if (this.options.actuator) {
            jQuery.data(this.options.actuator, 'active.boxy', false);
        }
    },
    
    // Move this dialog box above all other boxy instances
    toTop: function() {
        this.boxy.css({zIndex: Boxy._nextZ()});
        return this;
    },
    
    // Returns the title of this dialog
    getTitle: function() {
        return jQuery('> .title-bar h2', this.getInner()).html();
    },
    
    // Sets the title of this dialog
    setTitle: function(t) {
        jQuery('> .title-bar h2', this.getInner()).html(t);
        return this;
    },
    
    //
    // Don't touch these privates
    
    _getBoundsForResize: function(width, height) {
        var csize = this.getContentSize();
        var delta = [width - csize[0], height - csize[1]];
        var p = this.getPosition();
        return [Math.max(p[0] - delta[0] / 2, 0),
                Math.max(p[1] - delta[1] / 2, 0), width, height];
    },
    
    _setupTitleBar: function() {
        if (this.options.title) {
            var self = this;
            var tb = jQuery("<div class='title-bar'></div>").html("<h2>" + this.options.title + "</h2>");
            if (this.options.closeable) {
                tb.append(jQuery("<a href='#' class='close'></a>").html(this.options.closeText));
            }
            if (this.options.draggable) {
                tb[0].onselectstart = function() { return false; }
                tb[0].unselectable = 'on';
                tb[0].style.MozUserSelect = 'none';
                if (!Boxy.dragConfigured) {
                    jQuery(document).mousemove(Boxy._handleDrag);
                    Boxy.dragConfigured = true;
                }
                tb.mousedown(function(evt) {
                    self.toTop();
                    Boxy.dragging = [self, evt.pageX - self.boxy[0].offsetLeft, evt.pageY - self.boxy[0].offsetTop];
                    jQuery(this).addClass('dragging');
                }).mouseup(function() {
                    jQuery(this).removeClass('dragging');
                    Boxy.dragging = null;
                    self._fire('afterDrop');
                });
            }
            this.getInner().prepend(tb);
            this._setupDefaultBehaviours(tb);
        }
    },
    
    _setupDefaultBehaviours: function(root) {
        var self = this;
        if (this.options.clickToFront) {
            root.click(function() { self.toTop(); });
        }
        jQuery('.close', root).click(function() {
            self.hide();
            return false;
        }).mousedown(function(evt) { evt.stopPropagation(); });
    },
    
    _fire: function(event) {
        this.options[event].call(this);
    }
    
};
