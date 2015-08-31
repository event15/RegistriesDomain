/*******************************************************************************
 *
 * This mod portion allows a user to make the game go much smoother by
 * automatically adding points to each employees over time.
 *
 ******************************************************************************/
(function(){

    //Create the Simplicity module
    CrazyCodr.Simplicity = {};

    /**
     * Creates the html for the option panel that we will use
     */
    CrazyCodr.Simplicity.setupUI = function(){

        //Create the simplicity section html
        var html = "";
        html += '<div id="crazycodr_simplicity" class="centeredButtonWrapper">';
        html += '	<style>';
        html += '		#crazycodr_simplicity table input';
        html += '		{';
        html += '			width: auto;';
        html += '		}';
        html += '		#crazycodr_simplicity table';
        html += '		{';
        html += '			text-align: center;';
        html += '		}';
        html += '	</style>';
        html += '	<h2>Simplicity</h2>';
        html += '	<p>Increase your abilities at the end of each completed game:</p>';
        html += '	<select id="crazycodr_simplicity_level" style="max-width: 250px">';
        html += '		<option value="0">Not used</option>';
        html += '		<option value="5">Minimal (+5)</option>';
        html += '		<option value="10">Small (+10)</option>';
        html += '		<option value="15">Generous (+15)</option>';
        html += '		<option value="20">Large (+20)</option>';
        html += '		<option value="30">Extra-large (+30)</option>';
        html += '		<option value="50">Abusive (+50)</option>';
        html += '	</select>';
        html += '	</br>';
        html += '	<p>What do you want to increase on each game?</p>';
        html += '	<table>';
        html += '		<tr>';
        html += '			<td><label><input type="checkbox" id="crazycodr_simplicity_affected_technology" value="1" checked /> Technology</label></td>';
        html += '			<td><label><input type="checkbox" id="crazycodr_simplicity_affected_design" value="1" checked /> Design</label></td>';
        html += '		</tr>';
        html += '		<tr>';
        html += '			<td><label><input type="checkbox" id="crazycodr_simplicity_affected_speed" value="1" checked /> Speed</label></td>';
        html += '			<td><label><input type="checkbox" id="crazycodr_simplicity_affected_research" value="1" checked /> Research</label></td>';
        html += '		</tr>';
        html += '	</table>';
        html += '</div>';

        //Add the html to the newGameView's feature selection panel
        var findMe = document.getElementById("newGameView").getElementsByClassName("featureSelectionPanel featureSelectionPanelHiddenState")[0];
        findMe.innerHTML += html;

    };

    /**
     * When a game starts, we set the simplicity level in the data storage system
     * Uses the closeNewGameView event to detect that the game has started
     */
    CrazyCodr.Simplicity.setupCloseNewGameViewHandler = function(){

        //Extend closeNewGameView to include our code
        var previousCloseNewGameViewEventHandler = UI.closeNewGameView;
        UI.closeNewGameView = function(){

            //Process our ui enhancements
            switch(parseInt($('#crazycodr_simplicity_level').val()))
            {
                case 0:
                    //Nothing to change, user doesn't want to use simplicity
                    return;
                    break;

                default:

                    //Set the value in the settings
                    var dataStore = GDT.getDataStore(CrazyCodr.id);
                    dataStore.data.simplicity = {};
                    dataStore.data.simplicity.level = parseInt($('#crazycodr_simplicity_level').val());
                    dataStore.data.simplicity.affected = {};
                    dataStore.data.simplicity.affected.technology = $('#crazycodr_simplicity_affected_technology').is(':checked');
                    dataStore.data.simplicity.affected.design = $('#crazycodr_simplicity_affected_design').is(':checked');
                    dataStore.data.simplicity.affected.speed = $('#crazycodr_simplicity_affected_speed').is(':checked');
                    dataStore.data.simplicity.affected.research = $('#crazycodr_simplicity_affected_research').is(':checked');

                    //Load the data into the Simplicity scope
                    CrazyCodr.Simplicity.Level = dataStore.data.simplicity.level;
                    CrazyCodr.Simplicity.Affected = {};
                    CrazyCodr.Simplicity.Affected.Design = dataStore.data.simplicity.affected.design;
                    CrazyCodr.Simplicity.Affected.Technology = dataStore.data.simplicity.affected.technology;
                    CrazyCodr.Simplicity.Affected.Speed = dataStore.data.simplicity.affected.speed;
                    CrazyCodr.Simplicity.Affected.Research = dataStore.data.simplicity.affected.research;
                    break;

            }

            //Call the previous ui method
            previousCloseNewGameViewEventHandler();

        };

    };

    /**
     * When a game loads, we set the simplicity level in the data storage system if not set
     */
    CrazyCodr.Simplicity.setupLoadSaveHandler = function(){

        //Extend saves.loading using normal on/off handler system
        GDT.on(GDT.eventKeys.saves.loading, function(){

            //Get the data storage for this game
            var dataStore = GDT.getDataStore(CrazyCodr.id);

            //Check if simplicity is setup, if not set it up
            if(!dataStore.data.simplicity)
            {
                dataStore.data.simplicity = {};
            }
            if(!dataStore.data.simplicity.level)
            {
                dataStore.data.simplicity.level = 0;
            }
            if(!dataStore.data.simplicity.affected)
            {
                dataStore.data.simplicity.affected = {};
            }
            if(!dataStore.data.simplicity.affected.technology)
            {
                dataStore.data.simplicity.affected.technology = false;
            }
            if(!dataStore.data.simplicity.affected.design)
            {
                dataStore.data.simplicity.affected.design = false;
            }
            if(!dataStore.data.simplicity.affected.speed)
            {
                dataStore.data.simplicity.affected.speed = false;
            }
            if(!dataStore.data.simplicity.affected.research)
            {
                dataStore.data.simplicity.affected.research = false;
            }

            //Load the data into the Simplicity scope
            CrazyCodr.Simplicity.Level = dataStore.data.simplicity.level;
            CrazyCodr.Simplicity.Affected = {};
            CrazyCodr.Simplicity.Affected.Design = dataStore.data.simplicity.affected.design;
            CrazyCodr.Simplicity.Affected.Technology = dataStore.data.simplicity.affected.technology;
            CrazyCodr.Simplicity.Affected.Speed = dataStore.data.simplicity.affected.speed;
            CrazyCodr.Simplicity.Affected.Research = dataStore.data.simplicity.affected.research;

        });

        //Extend saves.loading using normal on/off handler system
        GDT.on(GDT.eventKeys.saves.saving, function(){

            //Get the data storage for this game
            var dataStore = GDT.getDataStore(CrazyCodr.id);

            //Check if simplicity is setup, if not set it up
            if(!dataStore.data.simplicity)
            {
                dataStore.data.simplicity = {};
            }
            if(!dataStore.data.simplicity.level)
            {
                dataStore.data.simplicity.level = 0;
            }
            if(!dataStore.data.simplicity.affected)
            {
                dataStore.data.simplicity.affected = {};
            }
            if(!dataStore.data.simplicity.affected.technology)
            {
                dataStore.data.simplicity.affected.technology = false;
            }
            if(!dataStore.data.simplicity.affected.design)
            {
                dataStore.data.simplicity.affected.design = false;
            }
            if(!dataStore.data.simplicity.affected.speed)
            {
                dataStore.data.simplicity.affected.speed = false;
            }
            if(!dataStore.data.simplicity.affected.research)
            {
                dataStore.data.simplicity.affected.research = false;
            }

            //Load the data into the Simplicity scope
            dataStore.data.simplicity.level = CrazyCodr.Simplicity.Level;
            dataStore.data.simplicity.affected.design = CrazyCodr.Simplicity.Affected.Design;
            dataStore.data.simplicity.affected.technology = CrazyCodr.Simplicity.Affected.Technology;
            dataStore.data.simplicity.affected.speed = CrazyCodr.Simplicity.Affected.Speed;
            dataStore.data.simplicity.affected.research = CrazyCodr.Simplicity.Affected.Research;

        });

    };

    /**
     * Used to increase the stats of each staff by X amount based on game settings
     */
    CrazyCodr.Simplicity.setupAfterReleaseGameHandler = function(){

        //Setup the afterReleaseGame event for simplicity handling
        GDT.on(GDT.eventKeys.gameplay.afterReleaseGame, function(){

            //For each existing staff, increase each valid affected stat by the level
            if(GameManager.company.staff.length > 0)
            {
                for(x = 0; x < GameManager.company.staff.length; x++)
                {
                    if(CrazyCodr.Simplicity.Affected.Design)
                    {
                        GameManager.company.staff[x].designFactor += (CrazyCodr.Simplicity.Level / 500);
                    }
                    if(CrazyCodr.Simplicity.Affected.Technology)
                    {
                        GameManager.company.staff[x].technologyFactor += (CrazyCodr.Simplicity.Level / 500);
                    }
                    if(CrazyCodr.Simplicity.Affected.Speed)
                    {
                        GameManager.company.staff[x].speedFactor += (CrazyCodr.Simplicity.Level / 500);
                    }
                    if(CrazyCodr.Simplicity.Affected.Research)
                    {
                        GameManager.company.staff[x].researchFactor += (CrazyCodr.Simplicity.Level / 500);
                    }
                }
            }

        });

    };

    /**
     * Used to setup the whole mod
     */
    CrazyCodr.Simplicity.runStartUp = function () {
        CrazyCodr.Simplicity.setupUI();
        CrazyCodr.Simplicity.setupCloseNewGameViewHandler();
        CrazyCodr.Simplicity.setupLoadSaveHandler();
        CrazyCodr.Simplicity.setupAfterReleaseGameHandler();
    };

})();