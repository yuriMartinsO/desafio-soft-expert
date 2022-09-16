import './App.css';
import TypeForm from './components/TypeForm';
import ProductForm from './components/ProductForm';
import { BrowserRouter, Routes, Route } from "react-router-dom";
import Header from './components/Header';

function App() {
    return (
        <BrowserRouter>
            <Routes>
                <Route>
                    <Route path="/" element={<Header />}/>
                    <Route path="/cadastrotipo" element={<TypeForm/>}/>
                    <Route path="/cadastroproduto" element={<ProductForm/>}/>
                </Route>
            </Routes>
        </BrowserRouter>
    );
}

export default App;
