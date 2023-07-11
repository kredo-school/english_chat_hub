import React from 'react';

const maskedUsername = (name) => {
    const username = name;
    const maskedUsername = username.charAt(0) + "*".repeat(username.length - 2) + username.charAt(username.length - 1);

    return maskedUsername;
}

const Reviews = ({ reviews, loading, urls}) => {
    if (loading) {
        return <h2>Loading...</h2>;
    }
    
    return (
        <div>
            {reviews.map((review, index) => (
                    <div className="reviews" key={review.id}>
                        <div className="row justify-content-center mb-5 mt-2">
                            <div className="col-md-1">
                                <i className="fa-solid fa-user avatar-icon"></i>
                            </div>
                            <div className="col-md-3 user-rating" style={{ flexDirection: 'column' }}>
                                <div className="profile-user mt-2">
                                    <div className="user-level">
                                    <img
                                        src={urls[index]}
                                        alt=""
                                        width="20px"
                                        height="25px"
                                        className=""
                                    />
                                    </div>
                                    <h3 className="username fs-3">{maskedUsername(review.name)}</h3>
                                </div>
                                <div className="rating-level mt-3">
                                    {[...Array(5)].map((_, i) => (
                                    <i
                                        key={i}
                                        className={`starPicker fa-solid fa-star ${
                                        i < review.rating ? 'on' : 'off'
                                        }`}
                                    ></i>
                                    ))}
                                </div>
                            </div>
                            <div className="col-md-8 review">
                                <p className="review-content">{review.content}</p>
                            </div>
                        </div>
                    <hr className="slider-item" style={{ height: '2px', backgroundColor: 'white', border: 0, opacity: 1 }} />
                    </div>
            ))}
        </div>
    );    
};

export default Reviews;