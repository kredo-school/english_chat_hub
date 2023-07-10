import React from 'react';

const Pagination = ({ reviewsPerPage, totalReviews, paginate}) => {
    const pageNumbers = [];

    for (let i = 1; i <=Math.ceil(totalReviews / reviewsPerPage); i++) {
        pageNumbers.push(i);
    }
    
    return (
        <nav>
            <ul className='pagination'>
                {pageNumbers.map(pageNumber => (
                    <li key={pageNumber} className='page-item'>
                        <a onClick={() => paginate(pageNumber)} href={`#${pageNumber}`} className='page-link'>
                            {pageNumber}
                        </a>
                    </li>
                ))}
            </ul>
        </nav>
    );
};
export default Pagination;