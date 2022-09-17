import React, { Component } from 'react';
import './../search.css';

class ProductSearchBox extends Component {
    constructor(props) {
        super(props);

        this.state = {
            options: ''
        }
    }

    getOptionItem = (item) => {
        return <div
            key={item.id}
            price={item.price}
            nameprod={item.name}
            typetax={item.type.tax_value}
            idprod={item.id}
            onClick={this.props.addProductItemAction}
            className='optionSearch'>{item.name}
        </div>;
    }

    addSearchProductItem = (e) => {
        let productName = e.target.value;

        if (!productName) {
            this.setState({
                options : ''
            });

            return;
        }

        const recipeUrl = `${process.env.REACT_APP_API_ENDPOINT}/api/product?productName=${productName}`;
        var optionsItems = [];

        fetch(recipeUrl)
            .then((response) => response.json())
            .then((data) => {
                data.forEach((item, index) => {
                    optionsItems.push(this.getOptionItem(item));
                });

                this.setState({
                    options : optionsItems
                });
            });
    }

    removeProductItem = () => {
        setTimeout(function () {
            this.setState({
                options : ''
            });
        }.bind(this), 400)
    }

    render() {
        return (
            <div className='search-container'>
                <input className='search-input' onBlur={this.removeProductItem} onChange={this.addSearchProductItem} placeholder='Pesquisar produto'/>
                <div className='container-options'>
                    {this.state.options}
                </div>
            </div>
        );
    }
}

export default ProductSearchBox;