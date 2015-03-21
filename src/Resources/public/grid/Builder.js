




//a = ['func1', 'func2'];
//
//b = function() {
//    this.func1 = function () {
//    }
//}
//
//c = {
//    'func1' : function(){}
//};
//
//Interface.implements(new b(), [a]);


$lia.bridge.dhtmlx = {};

$lia.bridge.dhtmlx.store = function(){
    /**
     * Contains all instances of $lia.bridge.dhtmlx.grid.builder
     */
    this.store = {};

    /**
     * Allows to create a new instance
     * @param {string} id
     * @return {object}
     */
    this.create = function(id){
        return this.store[id] = new this.builder(id);
    };

    /**
     * Get an instance already created
     *  or if config is present create a new object too
     * @param {string} id
     * @return {object}
     */
    this.get = function(id){
        return this.store[id] ? this.store[id] : this.create(id);
    }
};

$lia.bridge.dhtmlx.processor = {
    /**
     * Contains all instances of $lia.bridge.dhtmlx.grid.builder
     */
    'store' : {},

    /**
     * Allows to create a new instance of $lia.bridge.dhtmlx.grid.builder
     * @param {string} ajaxSource
     * @return {$lia.bridge.dhtmlx.processor.builder}
     */
    'create'  : function(ajaxSource){
        this.store[ajaxSource] = new this.builder(ajaxSource);
        return this.store[ajaxSource]
    },

    /**
     * Get an instance already created
     *  or if config is present create a new object too
     * @param {string} ajaxSource
     * @return {$lia.bridge.dhtmlx.processor.builder}
     */
    'get'  : function(ajaxSource){
        return this.store[ajaxSource]
            ? this.store[ajaxSource]
            : this.create(ajaxSource);
    }
};

$lia.bridge.dhtmlx.processor.builder = function(ajaxSource){
    this.dhtmlx          = null;
    this.ajaxSource      = ajaxSource;

    /**
     * Get the native Grid object of Dhtmlx
     * @return {dhtmlXGridObject}
     */
    this.getDhtmlxProcessorObject = function(){
        if(!this.dhtmlx){
            this.dhtmlx = new dataProcessor(this.ajaxSource);
        }
        return this.dhtmlx;
    };

    /**
     *
     * @param nameOfComponent
     * @return {dhtmlXGridObject}
     */
    this.init = function(nameOfComponent){
        var p = this.getDhtmlxProcessorObject();
        p.init(nameOfComponent);
        return p;
    }
};

$lia.bridge.dhtmlx.grid = {
    /**
     * Contains all instances of $lia.bridge.dhtmlx.grid.builder
     */
    'store' : {},

    /**
     * Allows to create a new instance of $lia.bridge.dhtmlx.grid.builder
     * @param {string} name
     * @param {object} config
     * @return {$lia.bridge.dhtmlx.grid.builder}
     */
    'create'  : function(name, config){
        this.store[name] = new this.builder(name);
        return this.store[name].setConfiguration(config);
    },

    /**
     * Get an instance already created
     *  or if config is present create a new object too
     * @param {string} name
     * @param {object} config
     * @return {$lia.bridge.dhtmlx.grid.builder}
     */
    'get'  : function(name, config){
        if(config){
           this.create(name, config);
        }
        else if(!this.store[name]){
            throw new Error('This dhtmlx grid is not present : '+ name);
        }
        return this.store[name];
    }
};

/**
 * Initialisation
 * @param {string} name
 * @return {$lia.bridge.dhtmlx.grid.builder}
 */
$lia.bridge.dhtmlx.grid.builder = function(name){
    this.name                 = name;
    this.dhtmlx               = null;
    this.dhtmlxDataProcessor  = null;
    this.ajaxSource           = '';
    this.dataProcessorEnabled = false;
    this.mappingConfig        = {
        'ajaxSource'             : 'setAjaxSource',
        'dataProcessorEnabled'   : 'enableDataProcessor'
    };

    /**
     *
     * @param {object} config
     * @return {$lia.bridge.dhtmlx.grid.builder}
     */
    this.setConfiguration = function(config){
        if(config) {
            $lia.forEach(this.mappingConfig, function(value, key){
                if (config[key]) {
                    this[value].call(this, config[key]);
                }
            }, this);
        }
        return this;
    };

    /**
     * Set the url of data source
     * @param {string}  ajaxSource
     * @return {$lia.bridge.dhtmlx.grid.builder}
     */
    this.setAjaxSource = function(ajaxSource){
        this.ajaxSource = ajaxSource;
        return this;
    };

    /**
     * Enable or disable the data Processor (useful for native dhtmlx crud(c|u|d) actions)
     * @param {boolean} enableDataProcessor
     * @return {$lia.bridge.dhtmlx.grid.builder}
     */
    this.enableDataProcessor = function(enableDataProcessor){
        this.dataProcessorEnabled = !!enableDataProcessor;
        if(this.dataProcessorEnabled) {
            this.dhtmlxDataProcessor = $lia.bridge.dhtmlx.processor.get(this.ajaxSource);
            //this.dhtmlxDataProcessor.
        }
        return this;
    };

    /**
     * Get the native Grid object of Dhtmlx
     * @return {dhtmlXGridObject}
     */
    this.getDhtmlxGridObject = function(){
        if(!this.dhtmlx) {
            this.dhtmlx = new dhtmlXGridObject(this.name);
        }
        return this.dhtmlx;
    };



    /**
     * Render of Dhtmlx Object (dhtmlXGridObject)
     * @return {void}
     */
    this.render = function(){
        var dhtmlx = this.getDhtmlxGridObject();
        dhtmlx.init();
        if(this.ajaxSource) {
            dhtmlx.load(this.ajaxSource);
        }
    }
};
