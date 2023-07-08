import React, {useState, useEffect} from 'react';
import Reviews from './components/Reviews';
import Pagination from './components/Pagination';



const Welcome = ({reviews, urls}) => {

    console.log(reviews.data, 'test');
    console.log(urls, 'urls');


    const [reviewList, setReviewList] = useState(reviews.data);
    const [urlList, setUrlList] = useState(urls);
    const [loading, setLoading] = useState(false);
    const [currentPage, setCurrentPage] = useState(1);
    const [reviewsPerPage] = useState(3);
    
    useEffect(() => {
        const fetchReviews = async () => {
          if (reviewList) {
              setLoading(false);
          }else {
              setLoading(true);
          }
        };
    
        fetchReviews();
      }, []);

      console.log(reviewList);
      console.log(urlList);

    // Get current reviews
    const indexOfLastReview = currentPage * reviewsPerPage;
    const indexOfFirstReview = indexOfLastReview - reviewsPerPage;
    const currentReviews = reviewList ? reviewList.slice(indexOfFirstReview, indexOfLastReview) : [];
    const currentUrls = urlList ? urlList.slice(indexOfFirstReview, indexOfLastReview) : [];


    // Change review
    const paginate = pageNumber => setCurrentPage(pageNumber);

    const totalReviews = reviewList.length;

    console.log(totalReviews);

    return (
        <div className="testimonial mb-5">
            <div className="section-header">
                <h3 className="mx-auto">Testimonial</h3>
            </div>
            <Reviews reviews={currentReviews} loading={loading} urls={currentUrls}/>

            <Pagination 
                reviewsPerPage={reviewsPerPage}
                totalReviews={totalReviews}
                paginate={paginate}
            />
        </div>
    );
};

export default Welcome;
