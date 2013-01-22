(function($) {

// config
var defaultOptions = {
    url: '/api/zipcode/',
    prefInputId: '#form_pref',
    cityInputId: '#form_city',
    townInputId: '#form_town',
    zipcodeInputId: '#form_zipcode',

    selectContainerId: '#zipcode-search-select-container',
    searchBtnId: '#zipcode-search-btn',
    selectStyle: { width: '300px' },
    nonOption: '以下から選択して下さい',

    errorMessage: '該当する住所が見つかりませんでした。',
    resultNotFoundMessage: '該当する住所が見つかりませんでした。'
};

var Zipcode = (function() {
    // Define a local copy of Zipcode
    var Zipcode = function(options) {
        return new Zipcode.fn.init(options);
    };

    Zipcode.prototype = {
        constructor: Zipcode,
        addresses: [],
        options: {}
    };
    Zipcode.fn = Zipcode.prototype;

    // class method
    Zipcode.setResult = function(options, pref, city, town) {
        $(options.prefInputId).val(pref);
        $(options.cityInputId).val(city);
        $(options.townInputId).val(town);
    };

    Zipcode.clearResult = function(options) {
        Zipcode.setResult(options, '', '', '');
        $(options.selectContainerId).text('');
    };

    Zipcode.updateResult = function(options, addresses, idx) {
        if (addresses[idx]) {
            obj = addresses[idx].obj;
            Zipcode.setResult(options, obj.pref, obj.city, obj.street ? obj.town + obj.street : obj.town);
        }
    };

    Zipcode.newOptions = function(addresses, options) {
        var $option, $options = [], nonOption = options.nonOption;

        if (nonOption) {
            $option = $('<option></option>')
            .attr('label', nonOption)
            .text(nonOption);

            $options.push($option);
        }

        for (var i = 0, length = addresses.length; i < length; i++) {
            obj = addresses[i];

            $option = $('<option></option>')
            .attr({
                label: obj.str,
                value: i
            })
            .text(obj.str);

            $options.push($option);
        }

        return $options;
    };

    Zipcode.newSelect = function(options, addresses, children) {
        return $('<select></select>')
        .css(options.selectStyle)
        .change(function() {
            Zipcode.updateResult(options, addresses, $(this).val());
        })
        .append(children);
    };

    // instance method
    Zipcode.fn.init = function(options) {
        this.addresses = [];
        this.options = $.extend(defaultOptions, options);

        return this;
    };

    Zipcode.fn.collect = function(collection) {
        var obj, address;

        if (!collection.length) {
            return;
        }

        for (var i = 0, length = collection.length; i < length; i++) {
            obj = collection[i];

            if (obj.street) {
                address = obj.pref + obj.city + obj.town + obj.street;
            } else {
                address = obj.pref + obj.city + obj.town;
            }

            this.addresses.push({ str: address, obj: obj });
        }
    };

    Zipcode.fn.setResult = function(pref, city, town) {
        Zipcode.setResult(this.options, pref, city, town);
    };

    Zipcode.fn.clearResult = function() {
        Zipcode.clearResult(this.options);
    };

    Zipcode.fn.updateResult = function(idx) {
        Zipcode.updateResult(this.options, this.addresses, idx);
    };

    Zipcode.fn.newOptions = function() {
        return Zipcode.newOptions(this.addresses, this.options);
    };

    Zipcode.fn.newSelect = function() {
        return Zipcode.newSelect(this.options, this.addresses, this.newOptions());
    };

    Zipcode.fn.init.prototype = Zipcode.fn;

    return Zipcode;
}());

var Event = (function() {
    // Define a local copy of Zipcode
    var Event = function() {
        return new Event.fn.init();
    };

    Event.prototype = {
        constructor: Event
    };
    Event.fn = Event.prototype;

    Event.success = function(z) {
        return function(data) {
            var length;

            z.addresses = []; // [{str: xxx, obj: xx}, ...]
            z.collect(data.home);
            z.collect(data.office);

            // update addresses
            z.clearResult();

            length = z.addresses.length;

            if (length == 0) {
                Event.resultNotFound(z)();
            } else if (length == 1) {
                Event.updateResult(z)();
            } else {
                Event.updateResults(z)();
            }
        };
    };
    Event.updateResult = function(z) {
        return function() {
            z.updateResult(0);
        };
    };
    Event.updateResults = function(z) {
        return function() {
            $(z.options.selectContainerId).append(z.newSelect());
        };
    };
    Event.resultNotFound = function(z) {
        return function() {
            alert(z.options.errorMessage);
        };
    };
    Event.error = function(z) {
        return function() {
            alert(z.options.errorMessage);
        };
    };
    Event.click = function(options) {
        // vars
        var clicked = false, z = Zipcode(options);

        // on click search button
        $(z.options.searchBtnId).click(function() {
            var zipcode = $(z.options.zipcodeInputId).val();

            if (clicked) {
                return false;
            }

            clicked = true;

            // ajax get to zip search api
            $.getJSON(z.options.url, { zipcode: zipcode }, Event.success(z))
            .error(Event.error(z));

            clicked = false;

            return false;
        });
    };

    Event.fn.init = function() {
        return this;
    };

    return Event;
}());

// expose namespace
Zipcode.Event = Event;
window.Zipcode = Zipcode;

}(jQuery));
