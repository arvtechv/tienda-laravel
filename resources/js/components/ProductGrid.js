import React from 'react';
import ReactDOM from 'react-dom';

function ProductGrid({ products, csrfToken, addCartUrlTemplate, showUrlTemplate }) {
    return (
        <div className="product-grid">
            {products.length > 0 ? products.map(product => (
                <div className="product-card-new" key={product.id}>
                    <a href={showUrlTemplate.replace('ID_PLACEHOLDER', product.id)} style={{textDecoration: 'none'}}>
                        {product.image ? (
                            <img src={`/storage/${product.image}`} alt={product.name} />
                        ) : (
                            <div style={{width:'100%', height:'140px', background:'#dde0e8', borderRadius:'8px', display:'flex', alignItems:'center', justifyContent:'center', fontSize:'2rem', marginBottom:'10px'}}>📦</div>
                        )}
                        <div className="p-name">{product.name}</div>
                        <div className="p-price">$ {product.price.toLocaleString()}</div>
                    </a>
                    <form action={addCartUrlTemplate.replace('ID_PLACEHOLDER', product.id)} method="POST">
                        <input type="hidden" name="_token" value={csrfToken} />
                        <button type="submit" className="btn-agregar-card">Agregar</button>
                    </form>
                </div>
            )) : (
                <div style={{gridColumn: 'span 4', textAlign: 'center', color: '#9CA3AF', padding: '40px'}}>
                    No hay productos aún.
                </div>
            )}
        </div>
    );
}

export default ProductGrid;

if (document.getElementById('react-product-grid')) {
    const el = document.getElementById('react-product-grid');
    const products = JSON.parse(el.getAttribute('data-products'));
    const csrfToken = el.getAttribute('data-csrf-token');
    const addCartUrlTemplate = el.getAttribute('data-cart-url');
    const showUrlTemplate = el.getAttribute('data-show-url');
    ReactDOM.render(
        <ProductGrid 
            products={products} 
            csrfToken={csrfToken} 
            addCartUrlTemplate={addCartUrlTemplate}
            showUrlTemplate={showUrlTemplate}
        />, 
    el);
}
