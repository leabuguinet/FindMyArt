import React from 'react';
import { baseUrl } from "../envjs.js";
import Masonry from 'react-masonry-css'
import Zoom from 'react-reveal/Zoom'; // Importing Zoom effect

const breakpointColumnsObj = {
  default: 3,
  1100: 2,
  1000: 2,
  600: 1
};




export default class Filter extends React.Component {

  constructor() {
    super();
    this.state = {
      pieces: [],
      filtered: [],
      searchValue: '',
    }
  }

  /**
   * https://fr.reactjs.org/docs/state-and-lifecycle.html
   * Cette méthode se déclenche à chaque fois qu'on fait un setState
   * @param prevProps
   * @param prevState
   */
  componentDidUpdate(prevProps, prevState) {
    if (prevState.searchValue !== this.state.searchValue) {
      this.fetchPieces();
    }
  }

  componentDidMount() {

    this.fetchPieces();

  }
  //
  // componentWillUnmount() {
  //
  // }

  render() {
    return (
      <div>
        {/* <button onClick={this.fetchPieces}>Fetch Pieces</button> */}
        <div className="searchsection">
          <div className="searchbox">

            <div className="search">
              <div>
                <input type="text" value={this.state.searchValue} onChange={this.updateSearch} placeholder="Artiste, oeuvre..." />
              </div>
            </div>
          </div>

          <ul class="ks-cboxtags">
            <li>
              <input onClick={this.updateTarget} type="checkbox" id="checkboxOne" value="StreetArt" />
              <label for="checkboxOne">Street Art</label>
            </li>
            <li>
              <input onClick={this.updateTarget} type="checkbox" id="contemporary-art" value="ContemporaryArt" />
              <label for="contemporary-art">Art Contemporain</label>
            </li>
            <li>
              <input onClick={this.updateTarget} type="checkbox" id="photography" value="Photography" />
              <label for="photography">Photographie</label>
            </li>
            <li>
              <input onClick={this.updateTarget} type="checkbox" id="digital-art" value="DigitalArt" />
              <label for="digital-art">Digital Art</label>
            </li>
          </ul>
        </div>


        <div className="wrapper masonry">
          <Masonry
            breakpointCols={breakpointColumnsObj}
            className="my-masonry-grid"
            columnClassName="my-masonry-grid_column"
          >

            {this.state.pieces.map(function (piece) {
              return (
                <div key={piece.id}>
                  <div>
                    <a href={baseUrl + "/show/" + piece.id}>
                      <Zoom>
                        <img className="headline" src={piece.findMyArtDisplayImage} />
                      </Zoom>
                    </a>
                  </div>
                </div>
              )
            })}
          </Masonry>
        </div>

      </div>
    )
  }
  /**
   * Cette fonction met à jour le state search avec la valeur reçue en paramètres
   * @param event
   */
  updateSearch = (event) => {
    this.setState({
      searchValue: event.target.value,
    })
  };
  updateTarget = (event) => {
    let valuesCheckbox = [];
    document.querySelectorAll('input[type="checkbox"]:checked').forEach(function (item) {
      valuesCheckbox.push(item.value);
    });

    // ex: valuesCheckbox = ["streetArt", "Photography"]
    let pieceFilter = [];
    if (valuesCheckbox.length) {
      // Filter = foreach qui retourne uniquement les valeurs répondants à la condition
      // Includes permet de vérifier qu'une chaine de caractère se trouve dans un tableau
      // tour 1 : la pièce à comme catégorie streeArt : est-ce que streetArt est dans le tableau ["streetArt", "Photography"] => Oui
      // tour 2 : la pièce à comme catégorie DigitalArt : est-ce que DigitalArt est dans le tableau ["streetArt", "Photography"] => Non
      pieceFilter = this.state.filtered.filter(piece => valuesCheckbox.includes(piece.style) );
    } else {
      pieceFilter = this.state.filtered;
    }

    this.setState({
      pieces: pieceFilter,
    })
  };
  fetchPieces = () => {
    fetch(
      baseUrl + '/api/pieces',
      {
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        },
        method: "POST",
        body: JSON.stringify({
          search: this.state.searchValue,
        })
      }
    ).then(response => response.json()).then(response => {
      let updatedPiecesList = response.piece;
      console.log(response);

      this.setState({
        pieces: updatedPiecesList,
        filtered: updatedPiecesList
      })

    })
  }
}