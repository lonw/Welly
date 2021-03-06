$(function() {
        var n, t, e = $("body");
        $(window).on("scroll", function() {
            n || (n = !0, e.css({
                pointerEvents: "none"
            })), clearTimeout(t), t = setTimeout(function() {
                e.css({
                    pointerEvents: "auto"
                }), n = !1
            }, 333)
        })
    }), window.console = window.console || {
        log: $.noop
    },
    function() {
        var n = this,
            t = n._,
            e = {},
            r = Array.prototype,
            o = Object.prototype,
            i = Function.prototype,
            a = r.push,
            u = r.slice,
            c = r.concat,
            l = o.toString,
            s = o.hasOwnProperty,
            f = r.forEach,
            p = r.map,
            h = r.reduce,
            d = r.reduceRight,
            m = r.filter,
            v = r.every,
            g = r.some,
            y = r.indexOf,
            w = r.lastIndexOf,
            b = Array.isArray,
            $ = Object.keys,
            x = i.bind,
            _ = function(n) {
                return n instanceof _ ? n : this instanceof _ ? (this._wrapped = n, void 0) : new _(n)
            };
        "undefined" != typeof exports ? ("undefined" != typeof module && module.exports && (exports = module.exports = _), exports._ = _) : n._ = _, _.VERSION = "1.6.0";
        var k = _.each = _.forEach = function(n, t, r) {
            if (null == n) return n;
            if (f && n.forEach === f) n.forEach(t, r);
            else if (n.length === +n.length) {
                for (var o = 0, i = n.length; i > o; o++)
                    if (t.call(r, n[o], o, n) === e) return
            } else
                for (var a = _.keys(n), o = 0, i = a.length; i > o; o++)
                    if (t.call(r, n[a[o]], a[o], n) === e) return; return n
        };
        _.map = _.collect = function(n, t, e) {
            var r = [];
            return null == n ? r : p && n.map === p ? n.map(t, e) : (k(n, function(n, o, i) {
                r.push(t.call(e, n, o, i))
            }), r)
        };
        var j = "Reduce of empty array with no initial value";
        _.reduce = _.foldl = _.inject = function(n, t, e, r) {
            var o = arguments.length > 2;
            if (null == n && (n = []), h && n.reduce === h) return r && (t = _.bind(t, r)), o ? n.reduce(t, e) : n.reduce(t);
            if (k(n, function(n, i, a) {
                    o ? e = t.call(r, e, n, i, a) : (e = n, o = !0)
                }), !o) throw new TypeError(j);
            return e
        }, _.reduceRight = _.foldr = function(n, t, e, r) {
            var o = arguments.length > 2;
            if (null == n && (n = []), d && n.reduceRight === d) return r && (t = _.bind(t, r)), o ? n.reduceRight(t, e) : n.reduceRight(t);
            var i = n.length;
            if (i !== +i) {
                var a = _.keys(n);
                i = a.length
            }
            if (k(n, function(u, c, l) {
                    c = a ? a[--i] : --i, o ? e = t.call(r, e, n[c], c, l) : (e = n[c], o = !0)
                }), !o) throw new TypeError(j);
            return e
        }, _.find = _.detect = function(n, t, e) {
            var r;
            return A(n, function(n, o, i) {
                return t.call(e, n, o, i) ? (r = n, !0) : void 0
            }), r
        }, _.filter = _.select = function(n, t, e) {
            var r = [];
            return null == n ? r : m && n.filter === m ? n.filter(t, e) : (k(n, function(n, o, i) {
                t.call(e, n, o, i) && r.push(n)
            }), r)
        }, _.reject = function(n, t, e) {
            return _.filter(n, function(n, r, o) {
                return !t.call(e, n, r, o)
            }, e)
        }, _.every = _.all = function(n, t, r) {
            t || (t = _.identity);
            var o = !0;
            return null == n ? o : v && n.every === v ? n.every(t, r) : (k(n, function(n, i, a) {
                return (o = o && t.call(r, n, i, a)) ? void 0 : e
            }), !!o)
        };
        var A = _.some = _.any = function(n, t, r) {
            t || (t = _.identity);
            var o = !1;
            return null == n ? o : g && n.some === g ? n.some(t, r) : (k(n, function(n, i, a) {
                return o || (o = t.call(r, n, i, a)) ? e : void 0
            }), !!o)
        };
        _.contains = _.include = function(n, t) {
            return null == n ? !1 : y && n.indexOf === y ? -1 != n.indexOf(t) : A(n, function(n) {
                return n === t
            })
        }, _.invoke = function(n, t) {
            var e = u.call(arguments, 2),
                r = _.isFunction(t);
            return _.map(n, function(n) {
                return (r ? t : n[t]).apply(n, e)
            })
        }, _.pluck = function(n, t) {
            return _.map(n, _.property(t))
        }, _.where = function(n, t) {
            return _.filter(n, _.matches(t))
        }, _.findWhere = function(n, t) {
            return _.find(n, _.matches(t))
        }, _.max = function(n, t, e) {
            if (!t && _.isArray(n) && n[0] === +n[0] && 65535 > n.length) return Math.max.apply(Math, n);
            var r = -1 / 0,
                o = -1 / 0;
            return k(n, function(n, i, a) {
                var u = t ? t.call(e, n, i, a) : n;
                u > o && (r = n, o = u)
            }), r
        }, _.min = function(n, t, e) {
            if (!t && _.isArray(n) && n[0] === +n[0] && 65535 > n.length) return Math.min.apply(Math, n);
            var r = 1 / 0,
                o = 1 / 0;
            return k(n, function(n, i, a) {
                var u = t ? t.call(e, n, i, a) : n;
                o > u && (r = n, o = u)
            }), r
        }, _.shuffle = function(n) {
            var t, e = 0,
                r = [];
            return k(n, function(n) {
                t = _.random(e++), r[e - 1] = r[t], r[t] = n
            }), r
        }, _.sample = function(n, t, e) {
            return null == t || e ? (n.length !== +n.length && (n = _.values(n)), n[_.random(n.length - 1)]) : _.shuffle(n).slice(0, Math.max(0, t))
        };
        var O = function(n) {
            return null == n ? _.identity : _.isFunction(n) ? n : _.property(n)
        };
        _.sortBy = function(n, t, e) {
            return t = O(t), _.pluck(_.map(n, function(n, r, o) {
                return {
                    value: n,
                    index: r,
                    criteria: t.call(e, n, r, o)
                }
            }).sort(function(n, t) {
                var e = n.criteria,
                    r = t.criteria;
                if (e !== r) {
                    if (e > r || void 0 === e) return 1;
                    if (r > e || void 0 === r) return -1
                }
                return n.index - t.index
            }), "value")
        };
        var T = function(n) {
            return function(t, e, r) {
                var o = {};
                return e = O(e), k(t, function(i, a) {
                    var u = e.call(r, i, a, t);
                    n(o, u, i)
                }), o
            }
        };
        _.groupBy = T(function(n, t, e) {
            _.has(n, t) ? n[t].push(e) : n[t] = [e]
        }), _.indexBy = T(function(n, t, e) {
            n[t] = e
        }), _.countBy = T(function(n, t) {
            _.has(n, t) ? n[t]++ : n[t] = 1
        }), _.sortedIndex = function(n, t, e, r) {
            e = O(e);
            for (var o = e.call(r, t), i = 0, a = n.length; a > i;) {
                var u = i + a >>> 1;
                o > e.call(r, n[u]) ? i = u + 1 : a = u
            }
            return i
        }, _.toArray = function(n) {
            return n ? _.isArray(n) ? u.call(n) : n.length === +n.length ? _.map(n, _.identity) : _.values(n) : []
        }, _.size = function(n) {
            return null == n ? 0 : n.length === +n.length ? n.length : _.keys(n).length
        }, _.first = _.head = _.take = function(n, t, e) {
            return null == n ? void 0 : null == t || e ? n[0] : 0 > t ? [] : u.call(n, 0, t)
        }, _.initial = function(n, t, e) {
            return u.call(n, 0, n.length - (null == t || e ? 1 : t))
        }, _.last = function(n, t, e) {
            return null == n ? void 0 : null == t || e ? n[n.length - 1] : u.call(n, Math.max(n.length - t, 0))
        }, _.rest = _.tail = _.drop = function(n, t, e) {
            return u.call(n, null == t || e ? 1 : t)
        }, _.compact = function(n) {
            return _.filter(n, _.identity)
        };
        var C = function(n, t, e) {
            return t && _.every(n, _.isArray) ? c.apply(e, n) : (k(n, function(n) {
                _.isArray(n) || _.isArguments(n) ? t ? a.apply(e, n) : C(n, t, e) : e.push(n)
            }), e)
        };
        _.flatten = function(n, t) {
            return C(n, t, [])
        }, _.without = function(n) {
            return _.difference(n, u.call(arguments, 1))
        }, _.partition = function(n, t, e) {
            t = O(t);
            var r = [],
                o = [];
            return k(n, function(n) {
                (t.call(e, n) ? r : o).push(n)
            }), [r, o]
        }, _.uniq = _.unique = function(n, t, e, r) {
            _.isFunction(t) && (r = e, e = t, t = !1);
            var o = e ? _.map(n, e, r) : n,
                i = [],
                a = [];
            return k(o, function(e, r) {
                (t ? r && a[a.length - 1] === e : _.contains(a, e)) || (a.push(e), i.push(n[r]))
            }), i
        }, _.union = function() {
            return _.uniq(_.flatten(arguments, !0))
        }, _.intersection = function(n) {
            var t = u.call(arguments, 1);
            return _.filter(_.uniq(n), function(n) {
                return _.every(t, function(t) {
                    return _.contains(t, n)
                })
            })
        }, _.difference = function(n) {
            var t = c.apply(r, u.call(arguments, 1));
            return _.filter(n, function(n) {
                return !_.contains(t, n)
            })
        }, _.zip = function() {
            for (var n = _.max(_.pluck(arguments, "length").concat(0)), t = Array(n), e = 0; n > e; e++) t[e] = _.pluck(arguments, "" + e);
            return t
        }, _.object = function(n, t) {
            if (null == n) return {};
            for (var e = {}, r = 0, o = n.length; o > r; r++) t ? e[n[r]] = t[r] : e[n[r][0]] = n[r][1];
            return e
        }, _.indexOf = function(n, t, e) {
            if (null == n) return -1;
            var r = 0,
                o = n.length;
            if (e) {
                if ("number" != typeof e) return r = _.sortedIndex(n, t), n[r] === t ? r : -1;
                r = 0 > e ? Math.max(0, o + e) : e
            }
            if (y && n.indexOf === y) return n.indexOf(t, e);
            for (; o > r; r++)
                if (n[r] === t) return r;
            return -1
        }, _.lastIndexOf = function(n, t, e) {
            if (null == n) return -1;
            var r = null != e;
            if (w && n.lastIndexOf === w) return r ? n.lastIndexOf(t, e) : n.lastIndexOf(t);
            for (var o = r ? e : n.length; o--;)
                if (n[o] === t) return o;
            return -1
        }, _.range = function(n, t, e) {
            1 >= arguments.length && (t = n || 0, n = 0), e = arguments[2] || 1;
            for (var r = Math.max(Math.ceil((t - n) / e), 0), o = 0, i = Array(r); r > o;) i[o++] = n, n += e;
            return i
        };
        var E = function() {};
        _.bind = function(n, t) {
            var e, r;
            if (x && n.bind === x) return x.apply(n, u.call(arguments, 1));
            if (!_.isFunction(n)) throw new TypeError;
            return e = u.call(arguments, 2), r = function() {
                if (!(this instanceof r)) return n.apply(t, e.concat(u.call(arguments)));
                E.prototype = n.prototype;
                var o = new E;
                E.prototype = null;
                var i = n.apply(o, e.concat(u.call(arguments)));
                return Object(i) === i ? i : o
            }
        }, _.partial = function(n) {
            var t = u.call(arguments, 1);
            return function() {
                for (var e = 0, r = t.slice(), o = 0, i = r.length; i > o; o++) r[o] === _ && (r[o] = arguments[e++]);
                for (; arguments.length > e;) r.push(arguments[e++]);
                return n.apply(this, r)
            }
        }, _.bindAll = function(n) {
            var t = u.call(arguments, 1);
            if (0 === t.length) throw Error("bindAll must be passed function names");
            return k(t, function(t) {
                n[t] = _.bind(n[t], n)
            }), n
        }, _.memoize = function(n, t) {
            var e = {};
            return t || (t = _.identity),
                function() {
                    var r = t.apply(this, arguments);
                    return _.has(e, r) ? e[r] : e[r] = n.apply(this, arguments)
                }
        }, _.delay = function(n, t) {
            var e = u.call(arguments, 2);
            return setTimeout(function() {
                return n.apply(null, e)
            }, t)
        }, _.defer = function(n) {
            return _.delay.apply(_, [n, 1].concat(u.call(arguments, 1)))
        }, _.throttle = function(n, t, e) {
            var r, o, i, a = null,
                u = 0;
            e || (e = {});
            var c = function() {
                u = e.leading === !1 ? 0 : _.now(), a = null, i = n.apply(r, o), r = o = null
            };
            return function() {
                var l = _.now();
                u || e.leading !== !1 || (u = l);
                var s = t - (l - u);
                return r = this, o = arguments, 0 >= s ? (clearTimeout(a), a = null, u = l, i = n.apply(r, o), r = o = null) : a || e.trailing === !1 || (a = setTimeout(c, s)), i
            }
        }, _.debounce = function(n, t, e) {
            var r, o, i, a, u, c = function() {
                var l = _.now() - a;
                t > l ? r = setTimeout(c, t - l) : (r = null, e || (u = n.apply(i, o), i = o = null))
            };
            return function() {
                i = this, o = arguments, a = _.now();
                var l = e && !r;
                return r || (r = setTimeout(c, t)), l && (u = n.apply(i, o), i = o = null), u
            }
        }, _.once = function(n) {
            var t, e = !1;
            return function() {
                return e ? t : (e = !0, t = n.apply(this, arguments), n = null, t)
            }
        }, _.wrap = function(n, t) {
            return _.partial(t, n)
        }, _.compose = function() {
            var n = arguments;
            return function() {
                for (var t = arguments, e = n.length - 1; e >= 0; e--) t = [n[e].apply(this, t)];
                return t[0]
            }
        }, _.after = function(n, t) {
            return function() {
                return 1 > --n ? t.apply(this, arguments) : void 0
            }
        }, _.keys = function(n) {
            if (!_.isObject(n)) return [];
            if ($) return $(n);
            var t = [];
            for (var e in n) _.has(n, e) && t.push(e);
            return t
        }, _.values = function(n) {
            for (var t = _.keys(n), e = t.length, r = Array(e), o = 0; e > o; o++) r[o] = n[t[o]];
            return r
        }, _.pairs = function(n) {
            for (var t = _.keys(n), e = t.length, r = Array(e), o = 0; e > o; o++) r[o] = [t[o], n[t[o]]];
            return r
        }, _.invert = function(n) {
            for (var t = {}, e = _.keys(n), r = 0, o = e.length; o > r; r++) t[n[e[r]]] = e[r];
            return t
        }, _.functions = _.methods = function(n) {
            var t = [];
            for (var e in n) _.isFunction(n[e]) && t.push(e);
            return t.sort()
        }, _.extend = function(n) {
            return k(u.call(arguments, 1), function(t) {
                if (t)
                    for (var e in t) n[e] = t[e]
            }), n
        }, _.pick = function(n) {
            var t = {},
                e = c.apply(r, u.call(arguments, 1));
            return k(e, function(e) {
                e in n && (t[e] = n[e])
            }), t
        }, _.omit = function(n) {
            var t = {},
                e = c.apply(r, u.call(arguments, 1));
            for (var o in n) _.contains(e, o) || (t[o] = n[o]);
            return t
        }, _.defaults = function(n) {
            return k(u.call(arguments, 1), function(t) {
                if (t)
                    for (var e in t) void 0 === n[e] && (n[e] = t[e])
            }), n
        }, _.clone = function(n) {
            return _.isObject(n) ? _.isArray(n) ? n.slice() : _.extend({}, n) : n
        }, _.tap = function(n, t) {
            return t(n), n
        };
        var F = function(n, t, e, r) {
            if (n === t) return 0 !== n || 1 / n == 1 / t;
            if (null == n || null == t) return n === t;
            n instanceof _ && (n = n._wrapped), t instanceof _ && (t = t._wrapped);
            var o = l.call(n);
            if (o != l.call(t)) return !1;
            switch (o) {
                case "[object String]":
                    return n == t + "";
                case "[object Number]":
                    return n != +n ? t != +t : 0 == n ? 1 / n == 1 / t : n == +t;
                case "[object Date]":
                case "[object Boolean]":
                    return +n == +t;
                case "[object RegExp]":
                    return n.source == t.source && n.global == t.global && n.multiline == t.multiline && n.ignoreCase == t.ignoreCase
            }
            if ("object" != typeof n || "object" != typeof t) return !1;
            for (var i = e.length; i--;)
                if (e[i] == n) return r[i] == t;
            var a = n.constructor,
                u = t.constructor;
            if (a !== u && !(_.isFunction(a) && a instanceof a && _.isFunction(u) && u instanceof u) && "constructor" in n && "constructor" in t) return !1;
            e.push(n), r.push(t);
            var c = 0,
                s = !0;
            if ("[object Array]" == o) {
                if (c = n.length, s = c == t.length)
                    for (; c-- && (s = F(n[c], t[c], e, r)););
            } else {
                for (var f in n)
                    if (_.has(n, f) && (c++, !(s = _.has(t, f) && F(n[f], t[f], e, r)))) break;
                if (s) {
                    for (f in t)
                        if (_.has(t, f) && !c--) break;
                    s = !c
                }
            }
            return e.pop(), r.pop(), s
        };
        _.isEqual = function(n, t) {
            return F(n, t, [], [])
        }, _.isEmpty = function(n) {
            if (null == n) return !0;
            if (_.isArray(n) || _.isString(n)) return 0 === n.length;
            for (var t in n)
                if (_.has(n, t)) return !1;
            return !0
        }, _.isElement = function(n) {
            return !(!n || 1 !== n.nodeType)
        }, _.isArray = b || function(n) {
            return "[object Array]" == l.call(n)
        }, _.isObject = function(n) {
            return n === Object(n)
        }, k(["Arguments", "Function", "String", "Number", "Date", "RegExp"], function(n) {
            _["is" + n] = function(t) {
                return l.call(t) == "[object " + n + "]"
            }
        }), _.isArguments(arguments) || (_.isArguments = function(n) {
            return !(!n || !_.has(n, "callee"))
        }), _.isFunction = function(n) {
            return "function" == typeof n
        }, _.isFinite = function(n) {
            return isFinite(n) && !isNaN(parseFloat(n))
        }, _.isNaN = function(n) {
            return _.isNumber(n) && n != +n
        }, _.isBoolean = function(n) {
            return n === !0 || n === !1 || "[object Boolean]" == l.call(n)
        }, _.isNull = function(n) {
            return null === n
        }, _.isUndefined = function(n) {
            return void 0 === n
        }, _.has = function(n, t) {
            return s.call(n, t)
        }, _.noConflict = function() {
            return n._ = t, this
        }, _.identity = function(n) {
            return n
        }, _.constant = function(n) {
            return function() {
                return n
            }
        }, _.property = function(n) {
            return function(t) {
                return t[n]
            }
        }, _.matches = function(n) {
            return function(t) {
                if (t === n) return !0;
                for (var e in n)
                    if (n[e] !== t[e]) return !1;
                return !0
            }
        }, _.times = function(n, t, e) {
            for (var r = Array(Math.max(0, n)), o = 0; n > o; o++) r[o] = t.call(e, o);
            return r
        }, _.random = function(n, t) {
            return null == t && (t = n, n = 0), n + Math.floor(Math.random() * (t - n + 1))
        }, _.now = Date.now || function() {
            return (new Date).getTime()
        };
        var M = {
            escape: {
                "&": "&amp;",
                "<": "&lt;",
                ">": "&gt;",
                '"': "&quot;",
                "'": "&#x27;"
            }
        };
        M.unescape = _.invert(M.escape);
        var R = {
            escape: RegExp("[" + _.keys(M.escape).join("") + "]", "g"),
            unescape: RegExp("(" + _.keys(M.unescape).join("|") + ")", "g")
        };
        _.each(["escape", "unescape"], function(n) {
            _[n] = function(t) {
                return null == t ? "" : ("" + t).replace(R[n], function(t) {
                    return M[n][t]
                })
            }
        }), _.result = function(n, t) {
            if (null == n) return void 0;
            var e = n[t];
            return _.isFunction(e) ? e.call(n) : e
        }, _.mixin = function(n) {
            k(_.functions(n), function(t) {
                var e = _[t] = n[t];
                _.prototype[t] = function() {
                    var n = [this._wrapped];
                    return a.apply(n, arguments), N.call(this, e.apply(_, n))
                }
            })
        };
        var D = 0;
        _.uniqueId = function(n) {
            var t = ++D + "";
            return n ? n + t : t
        }, _.templateSettings = {
            evaluate: /<%([\s\S]+?)%>/g,
            interpolate: /<%=([\s\S]+?)%>/g,
            escape: /<%-([\s\S]+?)%>/g
        };
        var S = /(.)^/,
            I = {
                "'": "'",
                "\\": "\\",
                "\r": "r",
                "\n": "n",
                "	": "t",
                "\u2028": "u2028",
                "\u2029": "u2029"
            },
            P = /\\|'|\r|\n|\t|\u2028|\u2029/g;
        _.template = function(n, t, e) {
            var r;
            e = _.defaults({}, e, _.templateSettings);
            var o = RegExp([(e.escape || S).source, (e.interpolate || S).source, (e.evaluate || S).source].join("|") + "|$", "g"),
                i = 0,
                a = "__p+='";
            n.replace(o, function(t, e, r, o, u) {
                return a += n.slice(i, u).replace(P, function(n) {
                    return "\\" + I[n]
                }), e && (a += "'+\n((__t=(" + e + "))==null?'':_.escape(__t))+\n'"), r && (a += "'+\n((__t=(" + r + "))==null?'':__t)+\n'"), o && (a += "';\n" + o + "\n__p+='"), i = u + t.length, t
            }), a += "';\n", e.variable || (a = "with(obj||{}){\n" + a + "}\n"), a = "var __t,__p='',__j=Array.prototype.join,print=function(){__p+=__j.call(arguments,'');};\n" + a + "return __p;\n";
            try {
                r = Function(e.variable || "obj", "_", a)
            } catch (u) {
                throw u.source = a, u
            }
            if (t) return r(t, _);
            var c = function(n) {
                return r.call(this, n, _)
            };
            return c.source = "function(" + (e.variable || "obj") + "){\n" + a + "}", c
        }, _.chain = function(n) {
            return _(n).chain()
        };
        var N = function(n) {
            return this._chain ? _(n).chain() : n
        };
        _.mixin(_), k(["pop", "push", "reverse", "shift", "sort", "splice", "unshift"], function(n) {
            var t = r[n];
            _.prototype[n] = function() {
                var e = this._wrapped;
                return t.apply(e, arguments), "shift" != n && "splice" != n || 0 !== e.length || delete e[0], N.call(this, e)
            }
        }), k(["concat", "join", "slice"], function(n) {
            var t = r[n];
            _.prototype[n] = function() {
                return N.call(this, t.apply(this._wrapped, arguments))
            }
        }), _.extend(_.prototype, {
            chain: function() {
                return this._chain = !0, this
            },
            value: function() {
                return this._wrapped
            }
        }), "function" == typeof define && define.amd && define("underscore", [], function() {
            return _
        })
    }.call(this), $(function() {
        function n(n) {
            window.ga && (console.log("Analytics event", n), ga("send", "event", n))
        }
        $(document).on("click", ".js-analytics-click", function(t) {
            if (window.ga) {
                t.shiftKey || t.altKey || t.ctrlKey || t.metaKey || t.wheel || 1 === t.button || t.preventDefault();
                var e = $(this),
                    r = e.data(),
                    o = e.attr("href");
                n({
                    eventCategory: "Link",
                    eventAction: r.action,
                    eventLabel: e.text() + " (" + o + ")",
                    hitCallback: function() {
                        t.isDefaultPrevented() && (location = o, console.log("Analytics hit callback"))
                    }
                })
            }
        }).on("copy", "code", function() {
            n({
                eventCategory: "Code",
                eventAction: "copy",
                eventLabel: window.getSelection && ("" + window.getSelection()).slice(0, 499),
                hitCallback: function() {
                    console.log("Analytics hit callback")
                }
            })
        })
    }), $(function() {
        $(".js-arrow").on("mousedown", function(n) {
            n.preventDefault();
            var t = $(this),
                e = t.data(),
                r = $(e.fotorama).data("fotorama");
            r && r.show({
                index: e.show,
                slow: n.altKey
            })
        })
    }), $(function() {
        var n = $("#fotorama");
        if (n[0] && window.Photos) {
            var t = $(window),
                e = $("body"),
                r = window.devicePixelRatio || 1,
                o = 160 * Math.round(Math.min(window.innerWidth * r, 1280) / 160),
                i = 1.5,
                a = 2.5,
                u = 2,
                c = 56,
                l = c * r,
                s = location.hash.replace(/^#/, ""),
                f = s.split("__")[0],
                p = _.keys(Photos),
                h = Photos[f] ? f : p[_.random(p.length - 1)],
                d = Photos[h],
                m = $.map(d.uuids, function(n) {
                    var t = "http://i.fotorama.io/" + n + "/";
                    return {
                        full: t,
                        img: t + "-/stretch/off/-/resize/" + o + "x/",
                        thumb: t + "-/scale_crop/" + l * i + "x" + l + "/center/",
                        id: h + "__" + n
                    }
                });
            console.log("# Fotorama events"), n.on("fotorama:ready fotorama:show fotorama:showend fotorama:load fotorama:error fotorama:fullscreenenter fotorama:fullscreenexit ", function(n, t, e) {
                console.log("## " + n.type), e && e.src || console.log("active image: " + t.activeFrame.img), e && (e.time && console.log("transition duration: " + Math.round(e.time) + "ms"), e.src && console.log(("fotorama:load" === n.type ? "loaded" : "broken") + " image: " + e.src)), console.log("")
            }).fotorama({
                data: m,
                clicktransition: "dissolve",
                width: "100%",
                ratio: i,
                hash: !0,
                maxheight: "100%",
                nav: "thumbs",
                margin: 2,
                shuffle: !0,
                thumbmargin: u,
                keyboard: {
                    space: !0
                },
                shadows: !1,
                fit: "cover"
            }), $("#photos-by").html('Photos <a href="' + d.by.href + '" class="js-analytics-click" data-action="outbound">by ' + d.by.title + "</a>");
            var v, g, y, w, b, x, k = n.data("fotorama"),
                j = $("#say-hi"),
                A = $("#say-hi-anchor"),
                O = 300;
            t.on("resize", function() {
                g = window.innerWidth, y = window.innerHeight, v = n.offset().top + n.height();
                var e = c,
                    r = {};
                520 > g ? e = c - 16 : 640 > g && (e = c - 8);
                var o = e * i,
                    l = Math.round(g / a);
                e !== w && (console.log("Resize thumbs to " + o + "×" + e + "px"), console.log(""), $.extend(r, {
                    thumbwidth: o,
                    thumbheight: e
                }), j.css({
                    bottom: e + 2 * u
                }), w = e), l !== b && (console.log("Set min height to " + l + "px"), console.log(""), $.extend(r, {
                    minheight: l
                }), b = l), k.setOptions(r), t.scroll()
            }).on("scroll", function() {
                var n = t.scrollTop();
                if (v + 64 > n + y) {
                    if (x || x === !1) return;
                    j.stop().show().fadeTo(O, 1), x = !0
                } else x && (j.stop().fadeTo(O, 0, function() {
                    j.hide()
                }), x = !1)
            }).resize(), j.on("click", "a", function(n) {
                n.preventDefault(), e.animate({
                    scrollTop: A.offset().top - 10
                }, O)
            })
        }
    }), $(function() {
        function n(n) {
            for (var t = {}, e = n.substring(n.indexOf("?") + 1).split("&"), r = 0; e.length > r; r++) {
                var o = e[r].split("="),
                    i = decodeURIComponent(o[0]),
                    a = decodeURIComponent(o[1]);
                i && a && (t[i] = "false" !== a ? "true" !== a ? a : !0 : !1)
            }
            return t
        }
        var t = n(location.search).domain;
        if (t) {
            var e = /^[a-z]+:\/\//,
                r = t.match(e),
                o = t.replace(e, "").replace(/\/.*/, ""),
                i = (r && r[0] || "http://") + o;
            $("#licensee").attr({
                href: i
            }).text(o)
        }
    }), $(function() {
        function n() {
            o.$menu && e(o.$menu.stop().css({
                marginTop: -10,
                opacity: 0
            }).show().animate({
                marginTop: 0,
                opacity: 1
            }, 200))
        }

        function t() {
            o.$menu && ($(".js-menu-down").data({
                used: !1
            }).removeClass("active"), o.$menu.stop().animate({
                marginTop: 20,
                opacity: 0
            }, 200, function() {
                $(this).hide()
            }))
        }

        function e(n) {
            var t = n.data();
            t && !t.ok && (t.ok = !0, n.on("click", function(n) {
                n.stopPropagation()
            }))
        }
        var r = $(document),
            o = r.data();
        $(".js-menu-down").on("click", function(e) {
            e.stopPropagation();
            var r = $(this),
                i = r.data(),
                a = i.used;
            t(), a || (i.used = !0, r.addClass("active"), o.$menu = r.next(".menu"), n())
        }), r.on("click keydown", function(n) {
            console.log("document click"), ("click" === n.type || 27 === n.keyCode) && t()
        })
    }), $(function() {
        $(".js-now-year").text((new Date).getFullYear())
    }), $(function() {
        $(".js-set-options").on("change", function() {
            var n = $($(this).data("fotorama")).data("fotorama"),
                t = {};
            n && ($(":input", this).each(function() {
                var n = $(this);
                t[n.attr("name")] = "checkbox" === n.attr("type") ? n.is(":checked") : n.val()
            }), n.setOptions(t))
        })
    }), $(function() {
        $(".js-shuffle").on("click", function(n) {
            n.preventDefault();
            var t = $(this),
                e = $(t.attr("data-fotorama")).data("fotorama");
            e && e.shuffle()
        })
    }), $(function() {
        function n(n, t, e, r) {
            n[0] && $.ajax({
                url: t,
                dataType: r || "jsonp",
                success: function(t) {
                    var r = +n.text() || 0;
                    n.text(r + e(t) || "")
                }
            })
        }

        function t(t) {
            n($("#twitter-counter"), "http://urls.api.twitter.com/1/urls/count.json?url=" + t, function(n) {
                return n.count
            })
        }
        t("fotoramajs.com"), t("fotorama.io"), n($("#github-counter"), "https://api.github.com/repos/artpolikarpov/fotorama", function(n) {
            return n.data.watchers_count
        })
    }), $(function() {
        function n(n) {
            location.replace(location.protocol + "//" + location.host + location.pathname.replace(/^\/?/, "/") + location.search + "#" + n), $('li[data-tag="' + n + '"').addClass("active").siblings().removeClass("active")
        }
        $(window), $(".js-tags").each(function() {
            function t(t, i) {
                if (!t || o[t]) {
                    e.toggleClass("tags-all", !t), i = _.extend({
                        time: 300
                    }, i);
                    var a = $();
                    t ? ($.each(o, function(n, e) {
                        t === n && $.each(e.items, function(n, t) {
                            a = a.add(t.stop().slideDown(i.time))
                        })
                    }), r.not(a).stop().slideUp(i.time)) : r.stop().slideDown(i.time), n(t)
                }
            }
            var e = $(this),
                r = $(e.data("selector")),
                o = {};
            r.each(function() {
                var n = $(this);
                $.each(n.data("tags").split(","), function(t, e) {
                    o[e] = o[e] || {
                        items: []
                    }, o[e].items.push(n)
                })
            });
            var i = $.map(o, function(n, t) {
                return {
                    title: t,
                    items: n.items
                }
            });
            i.sort(function(n, t) {
                return n.items.length < t.items.length
            }), i.push({
                title: ""
            }), $.each(i, function(n, r) {
                var o = $("<li></li>").attr({
                        "data-tag": r.title
                    }),
                    i = $('<a class="dashed"></a>').attr({
                        href: "#" + r.title
                    }).text(r.title),
                    a = $("<small></small>").text(r.items ? " " + r.items.length : "");
                i.on("click", function(n) {
                    n.preventDefault(), t(r.title)
                }), e.append(o.append(i).append(a))
            }), t(location.hash.replace(/^#?/, ""), {
                time: 0
            })
        })
    }), $(function() {
        $(".js-transition-switch").on("click", function(n) {
            n.preventDefault();
            var t = $(this),
                e = $(t.attr("data-fotorama")).data("fotorama");
            e && (t.addClass("active inverse").siblings().removeClass("active inverse"), e.setOptions({
                transition: t.text().toLowerCase()
            }))
        })
    });
