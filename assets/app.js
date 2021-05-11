/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)

import './styles/app.css';
import React from "react";
import ReactDOM from 'react-dom';
import App from "./js/app";
import ColorThief from '../node_modules/colorthief/dist/color-thief.mjs';



const RouteElement = document.getElementById('root');

if(RouteElement){
    ReactDOM.render(<App/>, document.getElementById('root'));
}

/* GLOBAL VARIABLES */ 

let button;
let button2;


/* FUNCTIONS */

//Display information about private individual and businesses


function showInfoIndividual() {

        let div = document.getElementById("info1");

        if (div.style.opacity == "0" || div.style.opacity == "") {
                 div.style.opacity = "1";
        } 
        else {
                div.style.opacity = "0";
        }

};

function showInfoBusiness() {

        let div2 = document.getElementById("info2");

        if (div2.style.opacity == "0" || div2.style.opacity == "") {
                 div2.style.opacity = "1";
        } 
        else {
                 div2.style.opacity = "0";
        }
};

// Get the three main colours of the artpiece displayed

function getMainColors(img){
        colorThief.getColor(img);

        let piecePalette = colorThief.getPalette(img);

        let firstColour = `rgb(${piecePalette[0]})`;
        let secondColour = `rgb(${piecePalette[1]})`;
        let thirdColour = `rgb(${piecePalette[2]})`;

        document.querySelector('.first-color').style.backgroundColor = firstColour;
        document.querySelector('.second-color').style.backgroundColor = secondColour;
        document.querySelector('.third-color').style.backgroundColor = thirdColour;
}


/* PRINCIPAL CODE */

/* Concept Page */

//Display information business and individuals


button = document.getElementById('button1');
        
if(button != null){

        button.addEventListener('click', showInfoIndividual);
};

button2 = document.getElementById('button2');

if(button2 != null){

        button2.addEventListener('click', showInfoBusiness);
};


/* Show piece page */

//Color Thief : display main colours of an art piece



const colorThief = new ColorThief();

        const img = document.querySelector('.img-colorthief');

        if(img != null) {
                
                if(img.complete){

                        getMainColors(img)
                
                } else {
                        img.addEventListener('load', function() {
       
                        getMainColors(img)
                });
                }
        };


