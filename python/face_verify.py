import os

os.environ["OPENCV_LOG_LEVEL"] = "SILENT"

import cv2
import json
import sys


def output(data):
    print(json.dumps(data, ensure_ascii=True))
    sys.exit(0)


def load_image(path):
    if not os.path.isfile(path):
        output({
            "success": False,
            "matched": False,
            "message": "Khong tim thay file anh."
        })

    image = cv2.imread(path)

    if image is None:
        output({
            "success": False,
            "matched": False,
            "message": "Khong the doc file anh."
        })

    return image


def detect_face(image, detector):
    height, width = image.shape[:2]

    detector.setInputSize((width, height))

    result = detector.detect(image)

    if result is None:
        return None

    faces = result[1]

    if faces is None or len(faces) == 0:
        return None

    largest_face = None
    largest_area = 0

    for face in faces:
        face_width = float(face[2])
        face_height = float(face[3])
        area = face_width * face_height

        if area > largest_area:
            largest_area = area
            largest_face = face

    return largest_face


def main():
    if len(sys.argv) != 5:
        output({
            "success": False,
            "matched": False,
            "message": "Thieu tham so nhan dien."
        })

    registered_path = sys.argv[1]
    captured_path = sys.argv[2]
    detector_model = sys.argv[3]
    recognizer_model = sys.argv[4]

    if not os.path.isfile(detector_model):
        output({
            "success": False,
            "matched": False,
            "message": "Khong tim thay model phat hien khuon mat."
        })

    if not os.path.isfile(recognizer_model):
        output({
            "success": False,
            "matched": False,
            "message": "Khong tim thay model nhan dien khuon mat."
        })

    registered_image = load_image(registered_path)
    captured_image = load_image(captured_path)

    try:
        detector = cv2.FaceDetectorYN.create(
            detector_model,
            "",
            (320, 320),
            0.9,
            0.3,
            5000
        )

        recognizer = cv2.FaceRecognizerSF.create(
            recognizer_model,
            ""
        )

        registered_face = detect_face(
            registered_image,
            detector
        )

        if registered_face is None:
            output({
                "success": False,
                "matched": False,
                "message": "Khong phat hien duoc khuon mat trong anh da dang ky."
            })

        captured_face = detect_face(
            captured_image,
            detector
        )

        if captured_face is None:
            output({
                "success": False,
                "matched": False,
                "message": "Khong phat hien duoc khuon mat trong anh vua chup."
            })

        registered_aligned = recognizer.alignCrop(
            registered_image,
            registered_face
        )

        captured_aligned = recognizer.alignCrop(
            captured_image,
            captured_face
        )

        registered_feature = recognizer.feature(
            registered_aligned
        )

        captured_feature = recognizer.feature(
            captured_aligned
        )

        score = recognizer.match(
            registered_feature,
            captured_feature,
            cv2.FaceRecognizerSF_FR_COSINE
        )

        threshold = 0.363

        matched = float(score) >= threshold

        if matched:
            message = "Khuon mat khop voi hanh khach da dang ky."
        else:
            message = "Khuon mat khong khop voi hanh khach da dang ky."

        output({
            "success": True,
            "matched": matched,
            "similarity": round(float(score), 4),
            "threshold": threshold,
            "message": message
        })

    except Exception as error:
        output({
            "success": False,
            "matched": False,
            "message": str(error)
        })


if __name__ == "__main__":
    main()