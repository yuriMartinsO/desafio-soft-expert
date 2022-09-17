import React, { Component } from 'react';
import Header from './Header';
import ProductSearchBox from './ProductSearchBox';

class SaleForm extends Component {
    constructor(props) {
        super(props);

        this.state = {
            productItemsArrayInfo: [],
            productItems: [],
            totalProductValue: 0,
            totalTaxesValues: 0,
            totalSale: 0
        }
    }

    defineProductQuantitiesArray = (e) => {
        let id = e.target.getAttribute('idprod');
        let typetax = e.target.getAttribute('typetax');
        let price = e.target.getAttribute('price');
        let quantity = e.target.value;

        let totalProduct = price * quantity;
        let totalTax = price * (typetax/100) * quantity;

        let productItemsArrayInfo = this.state.productItemsArrayInfo;

        productItemsArrayInfo[id] = {
            quantity: quantity,
            productId: id,
            totalProduct: totalProduct,
            totalTax: totalTax,
            total: totalProduct + totalTax
        };

        this.setState({
            productItemsArrayInfo: productItemsArrayInfo
        }, () => {
            this.defineTotals();
        });
    }

    defineTotals = () => {
        var totalProductValue = 0;
        var totalTaxesValues = 0;
        var totalSale = 0;

        this.state.productItemsArrayInfo.forEach((item, index) => {
            totalProductValue += item.totalProduct;
            totalTaxesValues += item.totalTax;
            totalSale += item.total;
            console.log(totalSale);
        });

        this.setState({
            totalProductValue: totalProductValue,
            totalTaxesValues: totalTaxesValues,
            totalSale: totalSale
        });
    }

    handleInputChange = (e) => {
        this.setState({
            [e.target.name]: e.target.value,
        });
    }

    addProductItem = (e) => {
        let productItems = this.state.productItems;
        let id = e.target.getAttribute('idprod');
        let name = e.target.getAttribute('nameprod');
        let typetax = e.target.getAttribute('typetax');
        let price = e.target.getAttribute('price');

        productItems[id] = this.getTableItem(id, name, typetax, price);

        this.setState({
            productItems: productItems
        });
    }

    getTableItem = (id, nameprod, typetax, price) => {
        return (
            <tr key={id}>
                <td>ID</td>
                <td>{nameprod}</td>
                <td className='inputnumber'>
                    <input
                        onChange={this.defineProductQuantitiesArray}
                        idprod={id}
                        price={price}
                        type='number'
                        typetax={typetax}
                        placeholder={this.props.placeholder}
                    />
                </td>
            </tr>
        );
    }

    createOrder = () => {
        const recipeUrl = `${process.env.REACT_APP_API_ENDPOINT}/api/order`;
        const postBody = {
            productItemsArrayInfo: this.state.productItemsArrayInfo
        };

        const requestMetadata = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(postBody)
        };

        fetch(recipeUrl, requestMetadata)
            .then(res => res.json())
            .then(response => {
                console.log(response);
                if (response.error) {
                    alert(response.errorsMessages[0]);
                    return;
                }

                alert('Venda criada com sucesso!');
            });
    }

    render() {
        return (
            <div>
                <Header />
                <form className='form-page'>
                    <div className='row'>
                        <div className='col-md-12 text-center'>
                            <ProductSearchBox addProductItemAction={this.addProductItem} />
                        </div>
                        <div className='col-md-12 mt-4'>
                            <div className='table-container'>
                                <table className="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nome do Produto</th>
                                            <th scope="col">Quantidade</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {this.state.productItems}
                                    </tbody>
                                </table>
                                <div>
                                    <br/>
                                    <div><b>Subtotal de produtos:</b> {this.state.totalProductValue}</div>
                                    <div><b>Total de impostos:</b> {this.state.totalTaxesValues}</div>
                                    <div><b>Total:</b> {this.state.totalSale}</div> 
                                </div>                            
                                <div className='text-right button-container'>
                                    <button type="button" onClick={this.createOrder}>Vender</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        );
    }
}

export default SaleForm;