import React, { Component } from 'react';
import InputText from './InputText';
import InputNumber from './InputNumber';
import Button from './Button';
import Select from './Select';
import Header from './Header';

class ProductForm extends Component {
    constructor(props) {
        super(props);

        this.state = {
            productName: '',
            productPrice: '',
            typeId: '',
            typeOptions: ''
        }

        this.getTypes();
    }

    handleInputChange = (e) => {
        this.setState({
            [e.target.name]: e.target.value,
        });
    }

    sendRequest = () => {
        const recipeUrl = `${process.env.REACT_APP_API_ENDPOINT}/api/product`;
        const postBody = {
            name: this.state.productName,
            price: this.state.productPrice,
            type_id: this.state.typeId
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
                if (response.error) {
                    alert(response.errorsMessages[0]);
                    return;
                }

                alert('Produto cadastrado com sucesso!');
            });
    }

    getOptions = (item) => {
        return <option key={item.id} value={item.id}>{item.name}</option>;
    }

    getTypes() {
        const recipeUrl = `${process.env.REACT_APP_API_ENDPOINT}/api/type`;
        var optionHtml = [];

        fetch(recipeUrl)
            .then((response) => response.json())
            .then((data) => {
                var first = false;

                data.forEach((item, index) => {
                    optionHtml.push(this.getOptions(item));

                    if (!first) {
                        first = true;
                        this.setState({
                            typeId : item.id
                        });
                    }
                });

                this.setState({
                    typeOptions : optionHtml
                });
            });
        
    }

    render() {
        return (
            <div>
                <Header />
                <form className='form-page'>
                    <div className='row'>
                        <div className='col-md-12 text-center'>
                            <label>
                                Nome do produto:
                            </label>
                            <InputText
                                name="productName"
                                placeholder="Ex: Farofa 200g"
                                action={this.handleInputChange}
                            />
                        </div>
                        <div className='col-md-12 text-center'>
                            <label>
                                Preço do produto:
                            </label>
                            <InputNumber
                                name="productPrice"
                                placeholder="Ex: 150.00"
                                action={this.handleInputChange}
                            />
                        </div>
                        <div className='col-md-12 text-center'>
                            <label>
                                Tipos:
                            </label>
                            <Select action={this.handleInputChange} name="typeId" options={this.state.typeOptions} />
                        </div>
                        <Button action={this.sendRequest}/>
                    </div>
                </form>
            </div>
        );
    }
}

export default ProductForm;